/**
 * Class Catalogue
 */

import Page from '../../cmatrix/lib/Page.class.js';

export default class Catalogue {
    
    constructor(){
        this.$Tree = $('#tilda-tool-typestree');
        this.TitleSrc = $('title').text();
        
        this.init();
    }
    
    init(){
        const Instance = this;
        
        // --- --- --- --- ---
        window.addEventListener('popstate', function(e){
            const State = e.state;
            
            Instance.$Tree.find('.cm-tree-node').removeClass('cm-active');
            Instance.$Tree.find('.cm-tree-node[data-code='+State.typeId+']').addClass('cm-active')[0].scrollIntoView();
        }, false);
        
        // --- скрол дерева
        const $Element = document.querySelector('.cm-tree-node.cm-active');
        if($Element) $Element.scrollIntoView();

        // --- клик по дереву
        Instance.$Tree.find('.cm-tree-node-label').on('click',function(){
            Instance.clickNode(this);
        });
        
    }
    
    // --- --- --- --- ---
    clickNode(node){
        const Instance = this;
        
        const $Node = $(node);
        const $Parent = $Node.parent();
        const Code = $Parent.data('code');
        const Label = $Parent.data('label');
        const Url = new Page().setParam('tp',Code).getUrl();
            
        $Node.closest('.cm-tree').find('.cm-tree-node').removeClass('cm-active');
        $Parent.addClass('cm-active');
            
        history.pushState({ typeId : Code }, null, Url);
        document.title = Instance.TitleSrc + ' | ' + Label;
    }
    
    
    

}
