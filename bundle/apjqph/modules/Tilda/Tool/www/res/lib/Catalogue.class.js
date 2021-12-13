/**
 * Class Catalogue
 */

import Page from '../../cmatrix/lib/Page.class.js';
import Tree from '../../cmatrix/lib/Tree.class.js';

export default class Catalogue {
    
    constructor(){
        const Instance = this;
        
        this.TitleSrc = $('title').text();
        
        this.Tree = new Tree($('#tilda-tool-typestree'),{
            isHistory : true,
            onClickNode : function($node){
                const Code = Instance.Tree.getNodeCode();
                const Label = Instance.Tree.getNodeLabel();
                const Url = new Page().setParam('tp',Code).getUrl();                
                
                history.pushState({ Code : Code }, null, Url);
                document.title = Instance.TitleSrc + ' | ' + Label;
            }
        });
        
        // --- --- --- --- ---
        window.addEventListener('popstate', function(e){
            const State = e.state;
            console.log('State',State);
            
            const $Node = Instance.Tree.getNode(State.Code).activeNode().scrollToNode();
        }, false);
        
    }
    
}
