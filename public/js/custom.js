$(document).ready(function () {
    $(document).on('click','.addAnswer',function(){

        var copy =  $(this).parents('.answers').html()
        $(this).parents('.answers').after(`<div class="row answers mt-2">${copy}</div>`);
        $('.deleteAnswer').removeAttr('disabled')
        checkRadio()
    })

    $(document).on('click','.deleteAnswer',function(){
        var len = $('.answers').length
        if (len > 1){
            if (len == 2){
                $('.deleteAnswer').attr('disabled','disabled')
            }
            $(this).parents('.answers').remove()
        }
        checkRadio()
    })
    
    function checkRadio() {
        $('input[name="right"]').each(function (e) {
            $(this).val(e)
        })
    }


    $(document).on('click','.btn_answers',function(e){
        e.preventDefault()
        var answer = $(this).attr('answer')
        $('#confirmForm').append(`<input type="hidden" name="answer" value="${answer}"/>`)
        $('#confirmForm').submit()
    })
})