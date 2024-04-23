$(document).ready(function(){

    $('#submit').click(function(e){
      e.preventDefault()
      
      let message = $('#msg-input').val()
      let incoming = $('#incoming').val()
      let outgoing = $('#outgoing').val()
      let btn = document.getElementById('submit')


      // crud operation using php

      btn.disabled = true


      let formdata = new FormData()
      formdata.append('message', message)
      formdata.append('incoming_id', incoming)
      formdata.append('outgoing_id', outgoing)

      $.ajax({
        type: 'POST',
        url: '../includes/insert-chat.php',
        data: formdata,
        processData: false,
        contentType: false,
        success: function(data){
            btn.disabled = false
            $('#msg-input').val('')
            return false;
        }
      })
    })
  })


  