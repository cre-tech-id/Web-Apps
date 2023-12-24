import _ from 'lodash';
window._ = _;

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '802eed0fe20ff0c5585d',
    cluster: 'ap1',
    forceTLS: true
  });

window.Echo.channel("chat").listen("MessageCreated", (event)=>{
    var sender =  document.getElementById("nama").value; 
    if(sender == event.sender)
    var chatjoinedmessage = '<li class="repaly"><p>'+event.message+'</p> <span class="time"></span></li>'
    else
    var chatjoinedmessage = '<li class="sender"><p>'+event.message+'</p> <span class="time"></span></li>'
    $('.chatboks').append(chatjoinedmessage);
});

