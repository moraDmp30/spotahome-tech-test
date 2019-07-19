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

        $('#download-properties').click(function () {
            var $element = $(this);
            var $form = $('#properties-form');

            $form.find('[name="page"]').val(-1);
            $form.submit();
        });

        $(document).on('click', '.page-link', function () {
            var $element = $(this);
            var $form = $('#properties-form');

            if ($element.hasClass('disabled')) {
                return;
            }

            $form.find('[name="page"]').val($element.data('page'));
            self.readSource();
        });

        $(document).on('click', '.sortable-link', function () {
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
            $form.find('[name="page"]').val(1);

            self.readSource();
        });
    },

    /**
     * Reads source and prints it as table content.
     */
    readSource: function () {
        var $container = $('#properties-container');
        var $table = $('#properties-table');
        var $form = $('#properties-form');
        var $inputs = $form.find('input');
        var values = {};
        var field = $form.find('[name="sort_field"]').val();
        var direction = $form.find('[name="sort_direction"]').val();

        $inputs.each(function () {
            values[$(this).attr('name')] = $(this).val();
        });

        $.ajax({
            url: $container.data('url'),
            type: 'GET',
            data: values,
            success: function (response) {
                $container.html(response['html']);
                var $cell = $container.find('th[data-field="' + field + '"]');
                if (direction == 'asc') {
                    $cell.addClass('sortable-link-asc');
                } else if (direction == 'desc') {
                    $cell.addClass('sortable-link-desc');
                }
            },
            error: function (response) {
                if ($table.length == 0) {
                    $container.html('<div class="alert alert-danger">There was an error while fetching data.</div>');
                } else {
                    $table.find('tbody').html('<tr><td colspan="5">There was an error while fetching data.</td></tr>');
                }
            },
            beforeSend: function () {
                $('.sortable-link').addClass('disabled');
                $('.page-link').addClass('disabled');
                if ($table.length == 0) {
                    $container.html('<div class="alert alert-info">Fetching data...</div>');
                } else {
                    $table.find('tbody').html('<tr><td colspan="5">Fetching data...</td></tr>');
                }
            },
            complete: function () {
                $('.sortable-link').removeClass('disabled');
                $('.page-link').removeClass('disabled');
            }
        });
    },
};