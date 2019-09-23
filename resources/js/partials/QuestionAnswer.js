export default class QuestionAnswer {
    constructor () {
        $ (document).ready(function() {
            function accordion() {
                $(this).toggleClass('active');
                $('.question').not(this).removeClass('active');
            }
            $('.question').on ('click', accordion)
        });
    }
};
