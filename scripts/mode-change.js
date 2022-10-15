$(document).ready(function() {

    $("#mode").click(function() {
        if ($(this).text() == 'Dark Mode') {
            $("#main-color").attr('href', '../css/cobra.css');
            $(this).text('Light Mode');
        } else if ($(this).text() == 'Light Mode') {
            $("#main-color").attr('href', '../css/peacock.css');
            $(this).text('Dark Mode');
        }
    });

});