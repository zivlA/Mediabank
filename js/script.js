"use strict";
(function() {
  var displayedData;
  var postBody = {};
  var progress = 0;

  var toggleUploadPage = function () {
    var uploadPage = $('#upload-page');
    uploadPage.hasClass('active-upload') ? uploadPage.removeClass('active-upload') : uploadPage.addClass('active-upload');
  }
  
  $('div.top-menu > .upload, div.top-controls > .close').click(function (event) {
    toggleUploadPage();
  })

  // When magnifying glass on image is clicked:
  $('#image-modal').on('show.bs.modal', function (event) {
    var result;
    var button = $(event.relatedTarget);
    var id = button.data('id')
    var modal = $(this);
  
    $.getJSON('testdata.json', function (data) {
      result = $.grep(data, function (e) {return e.id == id})[0];
      console.log(result)
      modal.find('.modal-img').attr('src', result['filepath']);
    })
  })

  Dropzone.options.dropzone = {
    addRemoveLinks: true,
    autoProcessQueue: false,
    maxFiles: 50,
    previewsContainer: '#queue-previews',
    previewTemplate: `
      <div class="dz-preview dz-file-preview">
        <div class="dz-details">
          <div class="dz-filename flex-align"><span data-dz-name></span></div>
          <div class="dz-size flex-align" data-dz-size></div>
          <img data-dz-thumbnail />
        </div>
        <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
        <!--<div class="dz-success-mark"><span>✔</span></div>
        <div class="dz-error-mark"><span>✘</span></div>
        <div class="dz-error-message"><span data-dz-errormessage></span></div>-->
      </div>
    `,
    url: 'partials/upload.php',

    init: function () {
      var dropzone = $('#dropzone');
      var uploadIcon = $('.fa-upload');
      var dzPrompt = $('.dz-message');
      var myDz = this;

      this.on('dragover', function () {
        dropzone.css('border', '2px dashed #3eadf9');
        dropzone.css('background-color', '#bfeaff');
        uploadIcon.css('color', '#3eadf9');
        uploadIcon.addClass('important-size-i');
        dzPrompt.css('color', '#3eadf9');
        dzPrompt.addClass('important-size-prompt');
      })
      
      this.on('dragleave', function () {
        dropzone.css('border', '2px dashed #a8a8a8');
        dropzone.css('background-color', 'white');
        uploadIcon.css('color', '#a8a8a8');
        uploadIcon.removeClass('important-size-i');
        dzPrompt.css('color', '#a8a8a8');
        dzPrompt.removeClass('important-size-prompt');
      })
      
      this.on('drop', function () {
        dropzone.css('border', '2px dashed #a8a8a8');
        dropzone.css('background-color', 'white');
        uploadIcon.css('color', '#a8a8a8');
        uploadIcon.removeClass('important-size-i');
        dzPrompt.css('color', '#a8a8a8');
        dzPrompt.removeClass('important-size-prompt');
      })
      
      this.on('removedfile', function () {
        if (this.files.length === 0) {
          dropzone.css('height', '100%');
        }
      })

      $('#submit-dz').on('click', function (e) {
        var eventName, eventYear, keywords;
        progress = 0;
        myDz.processQueue();

        // TODO: Get text inputs for info and then send POST request
        eventName = document.getElementById('inputEvent').value;
        eventYear = document.getElementById('inputYear').value;
        keywords = document.getElementById('inputKeywords').value;

        postBody['event'] = eventName;
        postBody['year'] = eventYear;
        postBody['keywords'] = keywords;
      })
      
      this.on('success', function (file, response) {
        myDz.processQueue();

        var filepath = response;
        
        postBody['path'] = $.parseJSON(filepath);

        if ((/\.(gif|jpg|jpeg|tiff|png)$/i).test(postBody['path']) === true) {
          postBody['type'] = "image";
        }

        $.post('api/media/create.php', postBody, function(res) {
          console.log(res);
        })
      })

      this.on('totaluploadprogress', function (response) {
        progress <= response ? progress = response : progress;
        console.log(progress);
        // $('.progress-bar').width(progress + '%');
      })

      this.on('addedfile', function () {
        $('#submit-dz').css('display', 'block');
      })
    }
  }
})()
