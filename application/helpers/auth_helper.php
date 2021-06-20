<?php

function is_logged_in()
{
    $ci = get_instance();
    if (!isset($ci->session->userdata['logged_in'])) {
        $ci->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Maaf! Anda harus login dulu.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('auth');
    }
}

function session_level()
{
    $ci = get_instance();
    if ($ci->session->userdata['level'] !== 'admin') {
        redirect('notfound');
    }
}

function logged_in()
{
    $ci = get_instance();
    if (isset($ci->session->userdata['logged_in'])) {
        redirect('administrator/dashboard');
    }
}
