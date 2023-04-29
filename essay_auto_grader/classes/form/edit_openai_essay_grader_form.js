define(['jquery'], function ($) {
    return {
        init: function (options) {
            var max_length = options.max_length;
            var prompt = options.prompt;
            var api_key = options.api_key;
            // Handler for when the question prompt textarea changes
            $('#id_prompt').on('change keyup paste', function () {
                var length = $(this).val().length;
                var remaining = max_length - length;
                $('#id_prompt_chars_remaining').text(remaining);
            });

            // Initialize the characters remaining counter
            $('#id_prompt').trigger('change');

            // Handler for when the API key input changes
            $('#id_api_key').on('change', function () {
                api_key = $(this).val();
            });

            // Handler for when the "Grade" button is clicked
            $('#id_grade_essay').on('click', function () {
                var essay = $('#id_response').val();
                if (!essay) {
                    alert('Please enter an essay to grade.');
                    return;
                }

                // Disable the button while grading is in progress
                $('#id_grade_essay').prop('disabled', true);

                // Show the loading indicator
                $('#id_loading').show();

                // Send the grading request to the server
                $.ajax({
                    url: options.ajax_url,
                    type: 'POST',
                    data: {
                        'prompt': prompt,
                        'essay': essay,
                        'api_key': api_key
                    },
                    success: function (response) {
                        // Update the score and feedback fields
                        $('#id_score').val(response.score);
                        $('#id_feedback').val(response.feedback);

                        // Hide the loading indicator
                        $('#id_loading').hide();

                        // Re-enable the button
                        $('#id_grade_essay').prop('disabled', false);
                    },
                    error: function (xhr, status, error) {
                        // Show an error message
                        alert('An error occurred while grading the essay: ' + error);

                        // Hide the loading indicator
                        $('#id_loading').hide();

                        // Re-enable the button
                        $('#id_grade_essay').prop('disabled', false);
                    }
                });
            });
        }
    };
});