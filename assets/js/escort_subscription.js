//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

function isOneCheckedI() {
    var valid = true;
    jQuery('input[name^="langs"]').each(function (index) {
        console.log('index', index)
        if (jQuery(this).is(':checked')) {
            valid = false;
        }
    })

    if (valid) {
        jQuery('label#langs_error').removeClass('hidden');
        jQuery('label#langs_error').addClass('is-invalid');
    } else {
        jQuery('label#langs_error').removeClass('is-invalid');
        jQuery('label#langs_error').addClass('hidden');
    }

    return valid;
}

function isOneCheckedS() {
    var valid = true;
    jQuery('input[name^="services"]').each(function (index) {
        console.log('index', index)
        if (jQuery(this).is(':checked')) {
            valid = false;
        }
    })

    if (valid) {
        jQuery('label#services_error').removeClass('hidden');
        jQuery('label#services_error').addClass('is-invalid');
    } else {
        jQuery('label#services_error').removeClass('is-invalid');
        jQuery('label#services_error').addClass('hidden');
    }

    return valid;
}

function isOneCheckedMP() {
    var valid = true;
    jQuery('input[name^="payment_methods"]').each(function (index) {
        console.log('index', index)
        if (jQuery(this).is(':checked')) {
            valid = false;
        }
    })

    if (valid) {
        jQuery('label#payment_methods_error').removeClass('hidden');
        jQuery('label#payment_methods_error').addClass('is-invalid');
    } else {
        jQuery('label#payment_methods_error').removeClass('is-invalid');
        jQuery('label#payment_methods_error').addClass('hidden');
    }

    return valid;
}

function isChecked() {
    var valid = true;
    if(jQuery('#politics').is(':checked')) {
        valid = false
    }

    /*if (valid) {
        jQuery('label#services_error').removeClass('hidden');
        jQuery('label#services_error').addClass('is-invalid');
    } else {
        jQuery('label#services_error').removeClass('is-invalid');
        jQuery('label#services_error').addClass('hidden');
    }*/

    return valid;
}

jQuery.validator.addMethod('filesize', function (value, element, param) {
    console.log(element)
    for (let i = 0; i < element.files.length; i++) {
        var size = element.files[i].size / 1024 / 1024;
        console.log(size > param)
        if (size > param) {
            return false;
        }
    }
    return true;
}, 'Las imagenes deben ser de menor o igual tamaño que {0} Mb');


jQuery.validator.addMethod("CustomRequired", jQuery.validator.methods.required, "");

jQuery.validator.addClassRules("isOneCheckedI", {
    CustomRequired: isOneCheckedI
});

jQuery.validator.addClassRules("isOneCheckedS", {
    CustomRequired: isOneCheckedI
});


var rules = [
    {
        username: {
            maxlength: 50,
            required: true,
            alphanumeric: true,
            remote: {
                url: wp_params.home_url + '/wp-json/escorts/v1/verify-username',
                type: "post"
            }
        },
        password: {
            maxlength: 10,
            minlength: 6,
            required: true
        },
        password_repeat: {
            equalTo: '#password',
            maxlength: 10,
            minlength: 6,
            required: true
        },
        first_name: { required: true },
        last_name: { required: true },
        email: {
            email: true,
            required: true,
            remote: {
                url: wp_params.home_url + '/wp-json/escorts/v1/verify-email',
                type: "post"
            }
        },
        'phone[value]': { required: true },
        'politics': { required: isChecked },
    },
    {
        visible_name: {
            required: true
        },
        stature: {
            required: true,
            number: true
        },
        weight: {
            required: true,
            number: true
        },
        description: {
            required: true,
            maxlength: 1000
        }
    },
    {
        featured_image: {
            required: true,
            accept: "image/jpeg, image/pjpeg, image/png", 
            filesize: 1
        },
        "images[]": { 
            accept: "image/jpeg, image/pjpeg, image/png", 
            filesize: 1
        },
        video: { accept: "video/mp4, video/3pg, video/mkv"  }
    },
    {
        'services[]': { required: isOneCheckedS },
        'payment_methods[efective]': { required: isOneCheckedMP },
        'payment_methods[bank_transfer]': { required: isOneCheckedMP },
        'payment_methods[others]': { required: isOneCheckedMP }
    },
    {

    },
];

var messages = [
    {
        username: {
            maxlength: "El usuario no puede contener mas de 50 caracteres",
            required: 'El usuario es obligatorio',
            remote: 'El usuario ya se encuentra en uso',
            alphanumeric: 'Solo se permiten numeros y letras, sin caracteres especiales',
        },
        password: {
            maxlength: "La contraseña no puede contener mas de 10 caracteres",
            minlength: "La contraseña no puede contener menos de 6 caracteres",
            required: "La contraseña es obligatoria"
        },
        password_repeat: {
            equalTo: "La confirmacion de contraseña debe coincidir con la contraseña",
            maxlength: "La confirmacion de contraseña no puede contener mas de 10 caracteres",
            minlength: "La confirmacion de contraseña no puede contener menos de 6 caracteres",
            required: "La confirmacion de contraseña es obligatoria"
        },
        first_name: { required: "Los nombres son obligatorios" },
        last_name: { required: "Los apellidos son obligatorios" },
        email: {
            email: "El formato no es correcto",
            required: "El email es obligatorio",
            remote: "El email ya se encuentra en uso"
        },
        'phone[value]': { required: "El telefono es obligatorio" },
        'politics': { required: "" }
    },
    {
        visible_name: {
            required: "El nombre para mostrar en el anuncio es obligatorio"
        },
        'langs[]': { required: '' },
        stature: {
            required: "La estatura es obligatoria",
            number: "La estatura solo puede contener numeros"
        },
        weight: {
            required: "El peso es obligatorio",
            number: "El peso solo puede contener numeros"
        },
        description: {
            required: "El texto del anuncio es obligatorio",
            maxlength: "El texto del anuncio no puede contener mas de 1000 caracteres"
        }
    },
    {
        featured_image: {
            required: "La imagen destacada es obligatoria",
            accept: "El formato del archivo es incorrecto, solo se aceptan imagenes (.jpg, .png)"
        },
        images: { accept: "El formato del archivo es incorrecto, solo se aceptan imagenes (.jpg, .png)" },
        video: { accept: "El formato del archivo es incorrecto, solo se aceptan videos" }
    },
    {
        'services[]': { required: '' },
        'payment_methods[efective]': { required: '' },
        'payment_methods[bank_transfer]': { required: '' },
        'payment_methods[others]': { required: '' }
    }
];



jQuery(document).ready(function () {

    if (jQuery('form#escort-subscription')) {

        var rulesStep = rules[0];
        var messagesStep = messages[0];

        var form = jQuery('form#escort-subscription');

        var validator = form.validate({
            errorClass: 'is-invalid',
            validClass: 'is-valid',
            rules: rulesStep,
            messages: messagesStep,
        });

    }

    jQuery(".next-step").click(function () {

        var rulesStep = rules[parseInt(jQuery(this).data('step')) - 1];
        var messagesStep = messages[parseInt(jQuery(this).data('step')) - 1];

        var form = jQuery('form#escort-subscription');

        var validator = form.validate({
            errorClass: 'is-invalid',
            validClass: 'is-valid',
            rules: rulesStep,
            messages: messagesStep,
        });

        if (form.valid()) {

            validator.destroy();

            if (animating) return false;
            animating = true;

            current_fs = jQuery(this).parent();
            next_fs = jQuery(this).parent().next();

            //activate next step on progressbar using the index of next_fs
            jQuery("#progressbar li").eq(jQuery("fieldset").index(next_fs)).addClass("active");

            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({ opacity: 0 }, {
                step: function (now, mx) {
                    //as the opacity of current_fs reduces to 0 - stored in "now"
                    //1. scale current_fs down to 80%
                    scale = 1 - (1 - now) * 0.2;
                    //2. bring next_fs from the right(50%)
                    left = (now * 50) + "%";
                    //3. increase opacity of next_fs to 1 as it moves in
                    opacity = 1 - now;
                    current_fs.css({
                        'transform': 'scale(' + scale + ')',
                        'position': 'absolute'
                    });
                    next_fs.css({ 'left': left, 'opacity': opacity });
                },
                duration: 800,
                complete: function () {
                    current_fs.hide();
                    animating = false;
                },
                //this comes from the custom easing plugin
                easing: 'easeInOutBack'
            });

            jQuery([document.documentElement, document.body]).animate({
                scrollTop: jQuery("#progressbar").offset().top
            }, 1000);

        }
    });

    jQuery(".previous-step").click(function () {
        
        if (animating) return false;
        animating = true;

        current_fs = jQuery(this).parent();
        previous_fs = jQuery(this).parent().prev();

        //de-activate current step on progressbar
        jQuery("#progressbar li").eq(jQuery("fieldset").index(current_fs)).removeClass("active");

        //show the previous fieldset
        previous_fs.show();
        //hide the current fieldset with style
        current_fs.animate({ opacity: 0 }, {
            step: function (now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale previous_fs from 80% to 100%
                scale = 0.8 + (1 - now) * 0.2;
                //2. take current_fs to the right(50%) - from 0%
                left = ((1 - now) * 50) + "%";
                //3. increase opacity of previous_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({ 'left': left });
                previous_fs.css({ 'transform': 'scale(' + scale + ')', 'opacity': opacity, position: 'relative' });
            },
            duration: 800,
            complete: function () {
                current_fs.hide();
                animating = false;
            },
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });

        jQuery([document.documentElement, document.body]).animate({
            scrollTop: jQuery("#progressbar").offset().top
        }, 1000);
    });

    jQuery(".submit").click(function () {
        return false;
    });


    jQuery('input#featured_image').on('change', function () { 
        var files = jQuery(this).prop('files')
        if (files && files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var img = jQuery('<img />', {
                    src: e.target.result,
                    height: '100%',
                    width: '100%'
                });

                jQuery('.featured-image-box > .item > label').empty();
                img.appendTo('.featured-image-box > .item > label');
            }

            reader.readAsDataURL(files[0]);
        }
    });

    jQuery('input#images, label[for="images"]').click(function(e) {
        var files = jQuery('input#images').prop("files");
        if (files !== undefined && files.length == 5) {
            e.preventDefault();
        }
    })

    jQuery('input#images').on("change", function () {
        var files = jQuery(this).prop("files");

        jQuery('.images-box .item:not(.main)').remove();

        for (let index = 0; index < files.length; index++) {
            const file = files[index];

            var reader = new FileReader();

            reader.onload = function (e) {

                var img = jQuery('<img />', {
                    src: e.target.result,
                    style: 'max-width: 100% ; max-height: 100%',
                });

                /*var divDelete = jQuery('<div >', {
                    class: 'images-delete-item',
                    'data-index': files.length - 1
                });*/

                var imageLabel = jQuery('<label >', {
                    for: 'images',
                    style: 'height: 130px'
                });

                var imageDiv = jQuery('<div >', {
                    class: 'col-md-2 item',
                    'data-index': files.length - 1
                });

                img.appendTo(imageLabel);

                imageLabel.appendTo(imageDiv)
                //divDelete.appendTo(imageDiv)

                imageDiv.appendTo('.images-box');
            }

            reader.readAsDataURL(file);
        }
    });

    jQuery('.rates label').click(function() {

            var label = jQuery(this);
            var type = label.attr('for').split('_')[1];
            var plan = label.attr('for').split('_')[0];

            jQuery("input[name='plan[type]']").prop("checked", false);
            jQuery("input#" + type).prop("checked", true);

            jQuery("input[name='plan[name]']").prop("checked", false);
            jQuery("input#" + plan).prop("checked", true);

            jQuery('.overlay').addClass('show');
            jQuery('form#escort-subscription').submit();
            
        console.log(jQuery('form#escort-edit-plan').length, jQuery('form#escort-subscription').length)

            if (jQuery('form#escort-edit-plan')) {
                jQuery('form#escort-edit-plan').submit()
            }
        
    });

    jQuery('.select-button label').click(function() {

        if (!jQuery(this).hasClass('selected-plan')) {
            jQuery('.select-button label').removeClass('selected-plan');
            jQuery(this).addClass('selected-plan');

            var label = jQuery(this).parent().prev().prev().prev().children('.checked');
            var type = label.attr('for').split('_')[1];

            jQuery("input#"+type).prop("checked", true);
        }

    });

    jQuery('a[rel="light"]').fancybox();


    if(jQuery('form#escort-edit-info')) {

        console.log('info')
        jQuery('form#escort-edit-info').validate({
            errorClass: 'is-invalid',
            validClass: 'is-valid',
            rules: {
                'phone[value]': { required: true },
                visible_name: {
                    required: true
                },
                stature: {
                    required: true,
                    number: true
                },
                weight: {
                    required: true,
                    number: true
                },
                description: {
                    required: true,
                    maxlength: 1000
                }
            },
            messages: {
                'phone[value]': { required: "El telefono es obligatorio" },
                visible_name: {
                    required: "El nombre para mostrar en el anuncio es obligatorio"
                },
                stature: {
                    required: "La estatura es obligatoria",
                    number: "La estatura solo puede contener numeros"
                },
                weight: {
                    required: "El peso es obligatorio",
                    number: "El peso solo puede contener numeros"
                },
                description: {
                    required: "El texto del anuncio es obligatorio",
                    maxlength: "El texto del anuncio no puede contener mas de 1000 caracteres"
                }
            },
        });
    }


    if (jQuery('form#escort-edit-photos')) {

        console.log('info')
        jQuery('form#escort-edit-photos').validate({
            errorClass: 'is-invalid',
            validClass: 'is-valid',
            rules: {
                featured_image: {
                    accept: "image/jpeg, image/pjpeg, image/png"
                },
                images: { accept: "image/jpeg, image/pjpeg, image/png" },
                video: { accept: "video/mp4, video/3pg, video/mkv" }
            },
            messages: {
                featured_image: {
                    required: "La imagen destacada es obligatoria",
                    accept: "El formato del archivo es incorrecto, solo se aceptan imagenes (.jpg, .png)"
                },
                images: { accept: "El formato del archivo es incorrecto, solo se aceptan imagenes (.jpg, .png)" },
                video: { accept: "El formato del archivo es incorrecto, solo se aceptan videos" }
            },
        });
    }

    if (jQuery('form#escort-edit-rates')) {

        console.log('info')
        jQuery('form#escort-edit-rates').validate({
            errorClass: 'is-invalid',
            validClass: 'is-valid',
            rules: {
                'payment_methods[efective]': { required: isOneCheckedMP },
                'payment_methods[bank_transfer]': { required: isOneCheckedMP },
                'payment_methods[others]': { required: isOneCheckedMP }
            },
            messages: {
                'payment_methods[efective]': { required: '' },
                'payment_methods[bank_transfer]': { required: '' },
                'payment_methods[others]': { required: '' }
            },
        });
    }


    if (jQuery('form#escort-edit-services')) {

        console.log('info')
        jQuery('form#escort-edit-services').validate({
            errorClass: 'is-invalid',
            validClass: 'is-valid',
            rules: {
                'services[]': { required: isOneCheckedS }
            },
            messages: {
                'services[]': { required: '' }
            },
        });
    }
});