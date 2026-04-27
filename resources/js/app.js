import './bootstrap';

import Turbolinks from 'turbolinks';
Turbolinks.start();

import { Application } from 'stimulus';
const application = Application.start();

const controllers = import.meta.glob('./controllers/*.js', { eager: true });
for (const path in controllers) {
    const name = path.match(/\/([^/]+?)_controller\.js$/)[1].replace(/_/g, '-');
    application.register(name, controllers[path].default);
}

$(function () {
    $('[data-toggle="popover"]').popover({
        html: true,
    });
});
