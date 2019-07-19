'use strict';

var Spotahome = {
    initialized: false,

    /**
     * Init.
     */
    init: function () {
        var self = this;

        if (self.initialized) {
            return;
        }

        self.initialized = true;
        self.bindEvents();
        self.readSource();
    },

    /**
     * Bind all required events.
     */
    bindEvents: function () {
        var self = this;

        $('.sortable-link').click(function () {
            var $element = $(this);
            var $form = $('#properties-form');
            var field = $form.find('[name="sort_field"]').val();
            var direction = $form.find('[name="sort_direction"]').val();

            if ($element.hasClass('disabled')) {
                return;
            }

            $('.sortable-link').removeClass('sortable-link-desc').removeClass('sortable-link-asc');
            if (field == $element.data('field')) {
                if (direction == 'asc') {
                    $form.find('[name="sort_direction"]').val('desc');
                    $element.addClass('sortable-link-desc');
                } else {
                    $form.find('[name="sort_direction"]').val('asc');
                    $element.addClass('sortable-link-asc');
                }
            } else {
                $form.find('[name="sort_field"]').val($element.data('field'));
                $form.find('[name="sort_direction"]').val('asc');
                $element.addClass('sortable-link-asc');
            }

            self.readSource();
        });
    },

    /**
     * Reads source and prints it as table content.
     */
    readSource: function () {
        var self = this;
        var $table = $('#properties-table');
        var $form = $('#properties-form');
        var $inputs = $form.find('input');
        var values = {};

        $inputs.each(function () {
            values[$(this).attr('name')] = $(this).val();
        });

        $.ajax({
            url: $table.data('url'),
            type: 'GET',
            data: values,
            success: function (response) {
                $table.find('tbody').html(response['html']);
            },
            error: function (response) {
                $table.find('tbody').html('<tr><td colspan="5">There was an error while fetching data</td></tr>');
            },
            beforeSend: function () {
                $('.sortable-link').addClass('disabled');
                $table.find('tbody').html('<tr><td colspan="5">Fetching data...</td></tr>');
            },
            complete: function () {
                $('.sortable-link').removeClass('disabled');
            }
        });
    },
};