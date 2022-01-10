/**
 * Class Catalogue
 */

import Page from '../../cmatrix/lib/Page.class.js';
import Tree from '../../cmatrix/lib/Tree.class.js';

export default class Catalogue {
    
    constructor(){
        const Instance = this;
        
        this.TitleSrc = $('title').text();
        
        this.Tree = new Tree($('#tilda-tool-tree'),{
            buttonSelectAll : $('#tilda-tool-tree-selectall-button'),
            onClickNode : function(tree,$node){ Instance.setHistory(tree) },
            onSelectAll : function(tree,$nodes){ Instance.setHistory(tree) },
        });
        
        // --- --- --- --- ---
        window.addEventListener('popstate', function(e){
            const State = e.state;
            console.log('State',State);
            
            Instance.Tree.selectNodes(e.state.Codes.split(',')).getFirstSelected().scrollToNode();
            
            const $Node = Instance.Tree.getNode(State.Code).activeNode().scrollToNode();
        }, false);
        
    }
    
    // --- --- --- --- ---
    /**
     * Формирование history, url, title
     */
    setHistory(tree){
        const Instance = this;
        
        const Codes = tree.getSelectedNodes().map((index,element) => { return $(element).data('code') }).get().join(',') || null;
        const Url = new Page().setParam('tp',Codes).getUrl();                
        const Label = (!Codes || (Codes && Codes.split(',').length > 1)) ? '*' : tree.getSelectedNode().data('label');
        
        history.pushState({ Codes : Codes }, null, Url);
        document.title = Instance.TitleSrc + ' | ' + Label;
    }
    
}
