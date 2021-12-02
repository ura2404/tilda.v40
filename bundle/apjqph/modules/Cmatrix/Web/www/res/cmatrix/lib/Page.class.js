/**
 * Class Page
 */

export default class Page {
    
    // --- --- --- --- ---
    constructor(){
        this.Page;
        this.Params;
    }
    
    init(){
        this.Page = window.location.href.split('?')[0];
        
        /*
        console.log(11,location.search.substring(1));
        console.log(22,location.search.substring(1).replace(/&/g, "\",\""));
        console.log(33,location.search.substring(1).replace(/&/g, "\",\"").replace(/=/g, "\":\""));
        console.log(44,decodeURI(location.search.substring(1).replace(/=+$/, '').replace(/&/g, "\",\"").replace(/=/g, "\":\"")));
        console.log(55,decodeURIComponent(location.search.substring(1).replace(/=+$/, '').replace(/&/g, "\",\"").replace(/=/g, "\":\"")));
        */
        //const Params = location.search.substring(1) ? JSON.parse('{"' + decodeURIComponent(location.search.substring(1).replace(/=+$/, '').replace(/&/g, "\",\"").replace(/=/g, "\":\"")) + '"}') : {};
        this.Params = location.search.substring(1) ? JSON.parse('{"' + decodeURIComponent(location.search.substring(1).replace(/=+$/,"").replace(/&/g, "\",\"").replace(/=/g, "\":\"")) + '"}') : {};
        //console.log(this.Page,this.Params);
     
        return this;   
    }
    
    reload(key,value){
        console.log(key,value);
        
        if(value) this.Params[key] = value;
        else delete this.Params[key];
        console.log(this.Params);

        
        const Href = this.Page + (Object.keys(this.Params).length ? '?'+ decodeURIComponent($.param(this.Params)) : '');
        console.log('Href=',Href);
        window.location.href = Href;
        
    }

}