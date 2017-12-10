$(function () {
    //Advanced form with validation
    var form = $('#wizard_with_validation').show();
    form.steps({
        headerTag: 'h3',
        bodyTag: 'fieldset',
        transitionEffect: 'slideLeft',
        onInit: function (event, currentIndex) {
            $.AdminBSB.input.activate();

            //Set tab width
            var $tab = $(event.currentTarget).find('ul[role="tablist"] li');
            var tabCount = $tab.length;
            $tab.css('width', (100 / tabCount) + '%');

            //set button waves effect
            setButtonWavesEffect(event);
        },
        onStepChanging: function (event, currentIndex, newIndex) {
            if (currentIndex > newIndex) { return true; }

            if (currentIndex < newIndex) {
                form.find('.body:eq(' + newIndex + ') label.error').remove();
                form.find('.body:eq(' + newIndex + ') .error').removeClass('error');
            }

            if (form.valid()) {
                // show page loader when changing
                $('.page-loader-wrapper').fadeIn(0);

                if (currentIndex == 0) {
                    search('', 'card-p1');
                    getPilihan1();
                }
                if (newIndex == 2) {
                    search('', 'card-p2');
                    getPilihan2();
                    setPilihan();
                }
            }

            form.validate().settings.ignore = ':disabled,:hidden';
            return form.valid();
        },
        onStepChanged: function (event, currentIndex, priorIndex) {
            setButtonWavesEffect(event);
        },
        onFinishing: function (event, currentIndex) {
            form.validate().settings.ignore = ':disabled';
            return form.valid();
        },
        onFinished: function (event, currentIndex) {
            swal({
                title: "Submit Data?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: "Tidak, batalkan!",
            }, function(isConfirm) {
                if (isConfirm) {
                    window.location = base_url + 'Siswa/Perusahaan/Pilih?p1='+ _pilihan1 +'&p2=' + _pilihan2;
                }
            });
        }
    });

    form.validate({
        errorPlacement: function errorPlacement(error, element) { element.before(error); },
        rules: {
            'confirm': {
                equalTo: '#password'
            }
        }
    });
});

function setButtonWavesEffect(event) {
    $(event.currentTarget).find('[role="menu"] li a').removeClass('waves-effect');
    $(event.currentTarget).find('[role="menu"] li:not(.disabled) a').addClass('waves-effect');
}
