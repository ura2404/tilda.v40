import Layout1 from '../cmatrix/lib/Layout1.class.js';
import Table from '../cmatrix/lib/Table.class.js';
import Pfilter from '../cmatrix/lib/Pfilter.class.js';

const layout1 = new Layout1($('#cm-tool-layout')).init();
const table = new Table($('#wi-tool-table')).init();
const pfilter = new Pfilter($('#wi-tool-pfilter')).init();


// --- --- --- --- ---
$(document).ready(() => {
    //console.log(table);
});
