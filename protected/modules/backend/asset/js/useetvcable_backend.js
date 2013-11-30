var yoohee = {
    registerEvents: function() {
        var self = this;

        $(window).on('resize', function() {
            self.setMainHeight();
        });
    },

    setMainHeight: function() {
        if ($('#main').length > 0) {
            $('#main').css('min-height', window.innerHeight - $('#header').height() - $('#footer').height());
        }
    },

    initialize: function() {
        var self = this;

        // Register events
        self.registerEvents();

        // Set #main min-height
        self.setMainHeight();

        $('.bootip').tooltip({
            placement: 'auto right'
        });
    }
}

$(document).ready(function() {
    
    /* Auto Load Chosen */
    
    if ($('.chzn-select').length > 0) {
        $('.chzn-select').chosen();
    };
    
    if ($('#Program_tv_show_favorite').is(':checked')){
        $('#Program_movie_of_the_month').attr('checked', false);
        $('#Program_movie_of_the_month').attr('disabled', true);
        $('#label_movie_of_the_month').addClass('muted');
    }
    
    if ($('#Program_movie_of_the_month').is(':checked')){
        $('#Program_tv_show_favorite').attr('checked', false);
        $('#Program_tv_show_favorite').attr('disabled', true);
        $('#label_tv_show_favorite').addClass('muted');
    }
        
    $('#Program_tv_show_favorite').on('change', function() {
        if ($('#Program_tv_show_favorite').is(':checked')){
            $('#Program_movie_of_the_month').attr('checked', false);
            $('#Program_movie_of_the_month').attr('disabled', true);
            $('#label_movie_of_the_month').addClass('muted');
        } else {
            $('#Program_movie_of_the_month').attr('disabled', false);
            $('#label_movie_of_the_month').removeClass('muted');
        }
    });
    
    if($('#Program_hbo_on_demand').is(':checked')){
        $('#channel_id').hide();
    }
    
    $('#Program_hbo_on_demand').on('change', function() {
        if($('#Program_hbo_on_demand').is(':checked')){
            $('#channel_id').hide();
        } else {
            $('#channel_id').show();
        }
    });
    
    $('#Program_movie_of_the_month').on('change', function() {
        if ($('#Program_movie_of_the_month').is(':checked')){
            $('#Program_tv_show_favorite').attr('checked', false);
            $('#Program_tv_show_favorite').attr('disabled', true);
            $('#label_tv_show_favorite').addClass('muted');
        } else {
            $('#Program_tv_show_favorite').attr('disabled', false);
            $('#label_tv_show_favorite').removeClass('muted');
        }
    });
    
    yoohee.initialize();
    
    /* Date Picker */
    
    if ($('.datepicker').length > 0) {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            setDate: new Date(),
            autoclose: true
        });
    };
    
    /* DateTime Picker */
    
    if ($('.form_datetime').length > 0) {
        $(".form_datetime").datetimepicker({
            format: 'yyyy-mm-dd hh:ii'
        });
    };
    
    /* Pager Style */
    
    $('.pagination ul').addClass('page').removeClass('yiiPager');
});