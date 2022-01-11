import Form from './lib/Form.class.js';

const formLogin = new Form($('cm-form'));

$('#cm-user').on('click',() => formLogin.show());