tinymce.init({
    selector: 'textarea',
    height: 500,
    menubar: false,
    theme_advanced_buttons3_add : "nonbreaking",
    nonbreaking_force_tab : true,
    fontsize_formats: "8px 9px 10px 11px 12px 13px 14px 15px 16px 17px 18px 19px 20px 21px 22px 23px 24px 25px 26px 27px 28px 36px",
    font_formats: 'Roboto = Roboto Condensed,sans-serif;Arial=arial,helvetica,sans-serif;Courier New=courier new,courier,monospace;AkrutiKndPadmini=Akpdmi-n',
   
    plugins: [
        'advlist autolink lists link image charmap print preview anchor textcolor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code help',
        'textcolor colorpicker',
        'nonbreaking',
        'link'

    ],
    toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help | forecolor backcolor | fontsizeselect | fontselect | link',

    content_css: [
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
        '//www.tinymce.com/css/codepen.min.css']
});
    