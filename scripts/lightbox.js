var imgN;

$(document).ready(function() {
    
    var id;
    
    var current;
    
    $('.thumb-hover').click(function() {
       id = $(this).attr('id');
       hid = '#H-'+id;
       fimg = $(hid).attr('src');
       ftxt = $(hid).html();
       $('.full-img').attr('src', fimg);
       $('.img-text').html(ftxt);
       $('.lightbox').removeClass('hidden');
       
       jid = '#J-'+id;
       imgN = parseInt($(jid).text());
       current = 1;
    });
    
    $('.close').click(function() {
       $('.lightbox').addClass('hidden');
    });
    
    $(".thumb-hover").keyup(function(event) { 
        if (event.keyCode === 13) { 
            $(this).click();
            $('.close').focus();
            $(".outer").find("*").attr("tabindex", "-1");
        } 
    });
    
    $(".close").keyup(function(event) { 
        if (event.keyCode === 13) { 
            $(this).click();
            $(".outer").find("*").removeAttr("tabindex");
            $(".outer").find(".thumb-hover").attr("tabindex", "0");
            $("#go-mini").attr("tabindex", "0");
            $("#go-big").attr("tabindex", "0");
            $("#"+id).focus();
        }
    });
    
    $(document).keyup(function(event) {
        if (event.keyCode === 27) {
            $('.lightbox').addClass('hidden');
            $(".outer").find("*").removeAttr("tabindex");
            $(".outer").find(".thumb-hover").attr("tabindex", "0");
            $("#go-mini").attr("tabindex", "0");
            $("#go-big").attr("tabindex", "0");
            $("#"+id).focus();
        }
    });
    
});

function useArrow(event) {
    if ((event.type === 'click') || (event.type === 'keyup' && event.keyCode === 13)) {
    if (!$(event.target).hasClass('crnt')) {
        current = $('.full-img').attr('src');
        currNoExt = current.substr(0, current.length-4);
        currNumArr = currNoExt.split('-');
        currNum = $(currNumArr).get(-1);
        numLength = currNum.length+1;
        fileLength = currNoExt.length-numLength;
        baseImg = currNoExt.substr(0, fileLength);
        currInt = parseInt(currNum);
        if ($(event.target).attr('id') === 'next') {
            wantDir = 'next';
            wantNum = currInt + 1;
            if (wantNum === imgN) {
                $(event.target).addClass('crnt');
                $(event.target).removeAttr('tabindex');
            }
        } else if ($(event.target).attr('id') === 'prev') {
            wantDir = 'prev';
            wantNum = currInt - 1;
            if (wantNum === 1) {
                $(event.target).addClass('crnt');
                $(event.target).removeAttr('tabindex');
            }
        }
        newImg = '../img/'+baseImg+'-'+wantNum+'.png';
        $('.full-img').attr('src', newImg);
        $('.arrow:not(#'+wantDir+')').removeClass('crnt');
        $('.arrow:not(#'+wantDir+')').attr('tabindex', '0');
    }
}
}