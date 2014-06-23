$(function(){
    function pageLoad(){
        $(".sortable").sortable({
            placeholder: 'list-group-item list-group-item-placeholder',
            forcePlaceholderSize: true
        });
        $("#nestable1").nestable({
            group: 1,
            maxDepth : 7
        });
        $("#nestable2").nestable({
            group: 1,
            maxDepth : 7
        });


        $("#navi-tree").disableSelection();
       

    }

    pageLoad();

    PjaxApp.onPageLoad(pageLoad);
});