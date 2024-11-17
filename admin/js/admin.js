jQuery(document).ready(function ($) {
    const { __ } = wp.i18n;
    const domain = "rc-spc";

    // Add test content
    $("#off_btn").on("click", function () {
        $("#change_kw").val(__("MY_KW", domain));
        $("#spintax_title").val(
            __(
                "This is {the best|the most {beautiful|awesome}} MY_KW {ever|from the {world|planet}|created}",
                domain
            )
        );
        $("#spintax_text").val(
            __(
                "<h3>I was {sitting|lying} and writing this text with the best MY_KW I {found|had|bought}.</h3><p>A {sample text|text|random sentence} for the MY_KW is very {strange|rare} but we only need {a few words|some words|a dummy data}.</p><p>¿Which <b>MY_KW</b> do yo {use|have|want}?</p>",
                domain
            )
        );
        $("#keywords").val(__("mouse\nkeyboard\nlaptop", domain));
    });
});
