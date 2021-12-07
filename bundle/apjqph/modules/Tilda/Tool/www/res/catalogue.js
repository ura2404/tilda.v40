import Layout1 from '../cmatrix/lib/Layout1.class.js';
import Table from '../cmatrix/lib/Table.class.js';
import Pfilter from '../cmatrix/lib/Pfilter.class.js';
import Page from '../cmatrix/lib/Page.class.js';

const layout1 = new Layout1($('#cm-tool-layout')).init();
const table = new Table($('#wi-tool-table')).init();
const pfilter = new Pfilter($('#wi-tool-pfilter')).init();

const ToolTypeId = new Page().init().getParam('tp');
if(ToolTypeId){
    $('#wi-tool-types').find(".cm-tree-node[data-code="+ToolTypeId+"]").children('.cm-tree-node-label').addClass('cm-node-selected ');
    const $Element = document.querySelector(".cm-tree-node[data-code='"+ToolTypeId+"']");
    if($Element) $Element.scrollIntoView();
}

// --- --- --- --- ---
$(document).ready(() => {
    //console.log(table);
        
    $('.cm-flip-panel').on('click',function(){
        $(this).closest('.cm-pfilter1').children().toggleClass('cm-active');
    });
    
    $('#wi-tool-types').find('.cm-tree-node-label').on('click',function(){
        const Code = $(this).parent().data('code');
        new Page().init().setParam('tp',Code).setParam('rs','types').reload();
    });
    
});
