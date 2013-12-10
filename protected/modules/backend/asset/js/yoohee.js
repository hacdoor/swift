var yoohee = {
    registerEvents: function() {
        var self = this;
        
        // Offcanvas
        $('[data-toggle=offcanvas]').click(function() {
            $('.row-offcanvas').toggleClass('active');
        });
        
        // File upload
        $('.form-upload-file').on('change', function() {
            self.previewUpload(this, 'file-upload-preview');
        });
        $('#toggle-upload').on('change', function() {
            if ($(this).is(':checked')) {
                $('.form-upload-file').removeAttr('disabled');
                $('#upload-preview').hide();
                $('#file-upload-preview').show();
            } else {
                $('.form-upload-file').attr('disabled', 'disabled');
                $('#upload-preview').show();
                $('#file-upload-preview').hide();
            }
        });
        
        // Change password
        $('#toggle-password').on('change', function() {
            if ($(this).is(':checked')) {
                $('#form-password').show();
            } else {
                $('#form-password').hide();
            }
        });
        
        // Datepicker
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose : true
        });
        
        // DateRange Picker
        $('.rangePicker').daterangepicker({
            timePicker: false,
            timePickerIncrement: 30,
            format: 'YYYY-MM-DD'
        });
        
        // Datepicker
        $('.dateSwift').datepicker({
            format: 'dd-mm-yyyy'
        });
        
        // Timepicker
        $('.dtpicker').datetimepicker({
            format: "yyyy-mm-dd hh:ii",
            autoclose: true
        });
        
        // Timepicker
        $('.timepicker').datetimepicker({
            format: "hh:ii",
            autoclose: true,
            maxView: 0,
            minView: 0,
            startView: 0
        });
        
        // Tooltip
        $('.bootip').tooltip({
            html: true
        });
        
        // Bootbox
        bootbox.setDefaults({
            animate: false
        });
        
        // Confirm delete
        $('.btn-delete').on('click', function(e) {
            var o = $(this);
            var confirmText = o.data('confirm');
            var href = o.attr('href');
            bootbox.confirm(confirmText, function(result) {
                if (result) {
                    window.location.href = href;
                }
            });
            return false;
        });
        
        // Confirm Confirm
        $('.btn-submit').click(function(e) {
            e.preventDefault();
            var o = $(this);
            var confirmText = o.data('confirm');
            bootbox.confirm(confirmText, function(result) {
                if (result) {
                    $('form').submit();
                }
            });
            return false;
        });
        
        $('.checkbox-column input:checkbox').change(function(){
            if($(this).is(":checked")) {
                $(this).parent().parent().addClass('selected');
                $('.btn-action input').removeClass('disabled');
                $('#DeleteButton').removeClass('disabled');
            } else {
                $(this).parent().parent().removeClass('selected');
                $('.btn-action input').addClass('disabled');
                $('#DeleteButton').removeClass('disabled');
            }
        });
        
        $('#selectedIds input:checkbox').change(function(){
            if($(this).is(":checked")) {
                $('.checkbox-column input:checkbox').parent().parent().addClass('selected');
                $('.checkbox-column input:checkbox').prop('checked', true);
                $('#DeleteButton').removeClass('disabled');
            } else {
                $('.checkbox-column input:checkbox').parent().parent().removeClass('selected');
                $('.checkbox-column input:checkbox').prop('checked', false);
                $('#DeleteButton').addClass('disabled');
            }
        });
        
        // Table add row
        $('.add-row').btnAddRow();
        $('.del-row').btnDelRow();
        
        // Colorbox
        $('.colorbox').colorbox({
            opacity: 0.5
        });
        
        // Isotope
        $('.media-images').isotope();
        
        // External link
        $('.external').on('click', function() {
            var href = $(this).attr('href');
            if (href) {
                window.open(href);
            }
            return false;
        });
        
        // Popover
        $('.ppv').popover({
            trigger: 'hover'
        });
        
        // Toggle event end time
        $('#ContentEvent_show_end_time').on('change', function() {
            if ($(this).is(':checked'))
                $('#event-end-time').show();
            else
                $('#event-end-time').hide();
        });
        
        // system.root permission
        $('.system-root').on('change', function() {
            if ($(this).is(':checked')) {
                $('.permission-list-item input[type=checkbox]').each(function() {
                    if (!$(this).hasClass('system-root')) {
                        $(this).attr('disabled', 'disabled');
                        $(this).addClass('disabled');
                        $(this).parent().addClass('muted');
                    }
                });
            } else {
                $('.permission-list-item input[type=checkbox]').each(function() {
                    if (!$(this).hasClass('system-root')) {
                        $(this).removeAttr('disabled');
                        $(this).removeClass('disabled');
                        $(this).parent().removeClass('muted');
                    }
                });
            }
        });
        
        // Admin group
        if ($('.admin-group').length > 0) {
            $('.admin-group').on('change', function() {
                var selGroup = $(this).val();
                if (selGroup != '') {
                    var htmlPerms = '';
                    for (i = 0; i < permissions[selGroup].length; i++) {
                        htmlPerms = htmlPerms + ' <span class="label label-default">' + permissions[selGroup][i] + '</span>';
                    }
                    $('#inherited-permissions').html(htmlPerms);
                    $('#inherited-permissions').show();
                } else {
                    $('#inherited-permissions').html('');
                    $('#inherited-permissions').hide();
                }
            });
        }
    },
    previewUpload: function(input, id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                $('#' + id).attr('src', e.target.result);
                $('#' + id).show();
                $('[data-preview=' + id + ']').hide();
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    },
    fixUI: function() {
        // Content height
        var windowHeight = window.innerHeight;
        $('#content-inner').css('min-height', windowHeight - 310);
        $('#content').css('min-height', windowHeight - 310);
        
        // Sidebar menu active state
        var path = window.location.pathname;
        $('.list-group-item').each(function() {
            var self = $(this);
            var href = self.find('a').attr('href');
            if (href == path) {
                self.addClass('active');
            }
        });
    },
    initialize: function() {
        
        /* Toggle Advance Search */
        
        $(".toggleSeach").click(function(){
            $(".advanceSearch").toggle();
        });
       
        /* Active MouseEnter */
        
        if($('.dropdown-menu li').hasClass('active')){
            $(this).parent().parent().addClass('active');
        }
        
        /* Auto Load Chosen */
        
        if ($('.chzn-select').length > 0) {
            $('.chzn-select').chosen();
        };
        
        /* Auto Hide Alert */
        
        $(".alert-dismissable").animate({
            opacity: 1.0
        }, 10000).fadeOut("slow");
        
        /* Confirm Leave Page */
        
        $('<input type="hidden" id="check" value="" name="check"/>').appendTo($('.form-actions'));
        
        if($('.form-horizontal .form-control').length > 0) {
            $('.form-horizontal .form-control').each(function(index, item){
                $(this).change(function(){
                    $('.form-horizontal #check').val('1');
                    if(!$('.form-horizontal input[type=submit]').data('clicked')){
                        function closeEditorWarning(){
                            return 'It looks like you have been editing something -- if you leave before submitting your changes will be lost.'
                        }
                        window.onbeforeunload = closeEditorWarning;
                        $('.form-horizontal input[type=submit]').click(function(){
                            window.onbeforeunload = null;
                        });
                    } else {
                        $('.form-horizontal input[type=submit]').click(function(){
                            window.onbeforeunload = null;
                        });
                    }
                });
            });
        };
        
        /* Add Form Input */
        
        if ($('#appendInput').length > 0) {
            var blockAppend = $('#appendInput');
            var i = $('#appendInput .innerInput').size() + 1;
            $('#addInput').live('click', function() {
                $('<div class="innerInput"><div class="row"><div class="col-md-9"><input class="form-control" maxlength="255" type="text" id="NamaPenerima" size="200" name="NamaPenerima[' + i +']" value="" placeholder="Nama Penerima" /></div><div class="col-md-3"><span id="delInput" class="btn btn-danger"><i class="icon-remove"></i> Remove</span></div></div>').appendTo(blockAppend);
                i++;
                return false;
            });
            $('#delInput').live('click', function() { 
                if( i > 2 ) {
                    $(this).parents('.innerInput').remove();
                    i--;
                }
                return false;
            });
        }
        
        /* Leave Page Confirm */
        
        if(!$('a').hasClass('btn-delete')){
            if(!$('.form-horizontal input[type=submit]').data('clicked')){
                $('a').each(function(){
                    if (!this.hash || !$('a').hasClass('chzn-single') || !this.hasClass('btn-delete') || !$('.form-horizontal input[type=submit]')) {
                        $(this).on('click', function(e) {
                            if(!$(this).hasClass('chzn-single')){
                                var check = $('.form-horizontal #check').val();
                                if(check.length){
                                    var o = $(this);
                                    var text = 'Anda yakin meninggalkan halaman ini ?';
                                    var href = o.attr('href');
                                    bootbox.confirm(text, function(result) {
                                        if (result) {
                                            window.location.href = href;
                                            window.onbeforeunload = null;
                                        }
                                    });
                                    return false;
                                }
                                return true;
                            };
                        });
                    };
                });
            };
        };
        
        /* Actived Dropdown */
        
        $('.dropdown').bind('mouseenter', function() {
            var $this = $(this);
            $this.addClass('selected');
        }).bind('mouseleave', function() {
            var $this = $(this);
            $this.removeClass('selected').children('div').css('z-index', '1');
        });
        
        /* Form Swift */
        
        $(".radio input[name$='optionsRadiosNasabah']").click(function() {
            var type = $(this).data('type');
            var t = (type == 1) ? 'formPerorangan' : 'formKorporasi'; 
            $(".formNasabah").hide();
            $("#" + t).show();
            $("#TypeForNasabah").val(type);
        });
        
        $('.setValue').each(function() {
            $(".setValue").click(function() {
                var type = $(this).data('type');
                $("#TypeNasabah").val(type);
            });
        });
        
        if ($(".radio input[name$='optionsRadiosNasabah']").is('checked')) {
            var type = $(this).data('type');
            $("#TypeForNasabah").val(type);
        }
        ;
        
        var type = $("#myTab li.active").data('type');
        $("#TypeNasabah").val(type);
        
        $('#kewarganegaraan').on('change', function() {
            var data = $(this).val();
            if (data == 1) {
                $("#formNegara").hide();
            } else {
                $("#formNegara").show();
            }
        });
        
        var self = this;
        
        self.registerEvents();
        self.fixUI();
        
        // Init change password
        if ($('#toggle-password').length > 0) {
            if ($('#toggle-password').is(':checked')) {
                $('#form-password').show();
            } else {
                $('#form-password').hide();
            }
        }
        
        // Init system-root permission
        if ($('.system-root').length > 0) {
            if ($('.system-root').is(':checked')) {
                $('.permission-list-item input[type=checkbox]').each(function() {
                    if (!$(this).hasClass('system-root')) {
                        $(this).attr('disabled', 'disabled');
                        $(this).addClass('disabled');
                        $(this).parent().addClass('muted');
                    }
                });
            } else {
                $('.permission-list-item input[type=checkbox]').each(function() {
                    if (!$(this).hasClass('system-root')) {
                        $(this).removeAttr('disabled');
                        $(this).removeClass('disabled');
                        $(this).parent().removeClass('muted');
                    }
                });
            }
        }
    }
}

$(document).ready(function() {
    yoohee.initialize();
});