import Catalogue from './lib/Catalogue.class.js';
import Layout1 from '../cmatrix/lib/Layout1.class.js';

/*
import Table from '../cmatrix/lib/Table.class.js';
import Pfilter from '../cmatrix/lib/Pfilter.class.js';
import Page from '../cmatrix/lib/Page.class.js';

const table = new Table($('#wi-tool-table')).init();
const pfilter = new Pfilter($('#wi-tool-pfilter')).init();
*/

new Layout1($('#cm-tool-layout')).init();
new Catalogue();

/*
const ToolTypeId = new Page().getParam('tp');
if(ToolTypeId){
    $('#wi-tool-types').find(".cm-tree-node[data-code="+ToolTypeId+"]").children('.cm-tree-node-label').addClass('cm-node-selected ');
    const $Element = document.querySelector(".cm-tree-node[data-code='"+ToolTypeId+"']");
    if($Element) $Element.scrollIntoView();
}
*/

/*
// --- скрол дерева
const $Element = document.querySelector(".cm-tree-node.cm-active");
console.log($Element);
if($Element) $Element.scrollIntoView();

const TitleSrc = $('title').text();
//$('title').attr('data-src',$('title').text());


// --- 
window.addEventListener('popstate', function(e){
    const State = e.state;
    console.log(State,e);
    
    const $Tree = $("#tilda-tool-typestree");
    $Tree.find('.cm-tree-node').removeClass('cm-active');
    $Tree.find('.cm-tree-node[data-code='+State.typeId+']').addClass('cm-active')[0].scrollIntoView();;
}, false);

// --- клик по дереву
$('#tilda-tool-typestree').find('.cm-tree-node-label').on('click',function(){
    const $Parent = $(this).parent();
    const Code = $Parent.data('code');
    const Label = $Parent.data('label');
    const Title = TitleSrc + ' | ' + Label;
    const Url = new Page().setParam('tp',Code).getUrl();
    console.log(Title);
    
    $(this).closest('.cm-tree').find('.cm-tree-node').removeClass('cm-active');
    $Parent.addClass('cm-active');
    
    history.pushState({ typeId : Code }, null, Url);
    document.title = Title;
});
*/
// --- --- --- --- ---
$(document).ready(() => {
    
    /*    
    $('.cm-flip-panel').on('click',function(){
        $(this).closest('.cm-pfilter1').children().toggleClass('cm-active');
    });
    
    $('#wi-tool-types').find('.cm-tree-node-label').on('click',function(){
        const Code = $(this).parent().data('code');
        //new Page().init().setParam('tp',Code).setParam('rs','types').reload();
        
        history.pushState({foo: 'bar'}, 'Title', new Page().setParam('tp',Code).setParam('rs','types').getUrl());

    });
    */
});