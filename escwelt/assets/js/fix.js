

$(document).ready(function () {

    var $document = $(this);


    $('form#new_review').on('submit', function (e) {
        e.preventDefault();
        var ths = $(this),
            test = true,
            thsInputs = ths.find('input');

        var this_form_id = this.id;



        thsInputs.each(function () {
            var thsInput = $(this),
                thsInputType = thsInput.attr('type'),
                thsInputVal =  thsInput.val(),
                inputReg = new RegExp(thsInput.data('reg')),
                inputTest = inputReg.test(thsInputVal);

            if (thsInput.attr('required')) {
                if (thsInputVal.length <= 0) {
                    test = false;
                    thsInput.addClass('error');
                    thsInput.focus();

                    if(thsInputType == 'file') thsInput.closest('.form_element--file').addClass('error');
                } else {
                    thsInput.removeClass('error');
                    if(thsInputType == 'file') thsInput.closest('.form_element--file').removeClass('error');
                    if (thsInput.data('reg')) {
                        if ( inputTest == false ) {
                            test = false;
                            thsInput.addClass('error');
                            thsInput.focus();
                        } else {
                            thsInput.removeClass('error');
                        }
                    }
                }
            }
        });
        if ( test ) {
            var form_data = ths.serialize();

            var thisForm = document.getElementById(this_form_id);
            var formData = new FormData(thisForm);

            $.ajax({
                url: ths.attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(r) {
                    window.location.href = ths.find('input[name="redirect"]').val();
                },
                error:  function(xhr, str){
                    console.log('Возникла ошибка: ' + xhr.responseCode);
                }
            });
        }

    });

    $('.form_input_file').on('change', function () {
        var ths = $(this),
            fileNameSelector = ths.closest('.form_element--file').find('.placeholder'),
            placeholder = fileNameSelector.attr('data-placeholder'),
            thsLength = ths[0].files.length;

        if(thsLength>0) {
            fileNameSelector.text('');

            for (var i = 0; i < thsLength; i++) {

                if (i+1 == thsLength) {
                    fileNameSelector.append(ths[0].files[i].name);
                }else {
                    fileNameSelector.append(ths[0].files[i].name + ', ');
                }

            }
        }else {
            fileNameSelector.text(placeholder);
        }



    });

    $('.load-review-js').on('click', function (e) {
        e.preventDefault();

        var $ths = $(this);

        var all = Number($ths.attr('data-all-posts'));
        var active = Number($ths.attr('data-active-length'));
        var length = Number($ths.attr('data-length'));

        var id = $ths.attr('data-page-id');

        var data = {
            action: 'load_reviews',
            all: all,
            active: active,
            length: length,
            id: id
        };

        $.ajax({
            url: admin_ajax,
            type: 'POST',
            data: data,
            success: function(r) {
                if(r) {
                    $('.testimonial_blocks').append(r);

                    $ths.attr('data-active-length', countReviws());

                    if(countReviws() == all) {
                        $ths.hide();
                    }
                }else {
                    $ths.hide();
                }

            },
            error:  function(xhr, str){
                console.log('Возникла ошибка: ' + xhr.responseCode);
            }
        });

    });
    $document.on('keypress', '#number_of_persons--js', function (e) {
        if (e.keyCode < 48 || e.keyCode > 57) return false;
    });
    $document.on('change', '#number_of_persons--js', function (e) {
        if (e.keyCode < 48 || e.keyCode > 57) return false;

        var $ths = this;

        var val = Number($ths.value);

        var min = Number($ths.getAttribute('data-min'));
        var max = Number($ths.getAttribute('data-max'));

        var value = min;

        if(val <= min){
            value = min;
        }
        if(val >= max){
            value = max;
        }

        $ths.value = value;
    });

    addClassessInMenu();

    $('.scroll_btn-js').on('click', function (e) {
        e.preventDefault();

        var $ths = $(this);
        var href = $ths.attr('href');

        var $el = $(href);

        var offsetTop = $el.offset().top;
        var h = $el.outerHeight();

        // var scrollTop = offsetTop - (h / 2) - $(".header").outerHeight();
        var scrollTop = offsetTop - (h / 2);

        console.log(offsetTop);
        console.log(h);

        $('body,html').animate({
            scrollTop: scrollTop
        }, 700);
    });

    $('.scroll-btn-js').on('click', function (e) {
        e.preventDefault();
        if(window.innerWidth > 991 && $('#fullpage').length) {

            var id = $(this).attr('href').replace('#', '');

            $.fn.fullpage.moveTo(id);
        }
    });

});

function addClassessInMenu() {
    var $items = $('.menu-item');

    $items.each(function () {

        var $ths = $(this);
        var $child = $ths.find('.sub-menu');
        var is_child = $child.length > 0;

        $ths.addClass('nav_el');

        $ths.find('a').addClass('nav_link');

        if(is_child) {

            $ths.addClass('has_child');

            $child.addClass('nested_nav_list');

            var $child_items = $child.find('li');

            $child_items.each(function () {

                var $t = $(this);

                $t.addClass('nested_nav_el');

                var text =  $t.find('a').text();

                $t.find('a').addClass('nested_nav_link');

                $t.find('a').html('<span>'+text+'</span>');
            });

        }

    });

    $('a.nested_nav_link').each(function () {
        $(this).removeClass('nav_link')
    })

}


function countReviws() {
    return $(document).find('.testimonial_block').length;
}




