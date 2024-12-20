<?php

it('renders admin registration view', function () {
    $response = $this->get(route('admin.register'));
    $response->assertSuccessful();
    $response->assertViewIs('pages.auth.admin-register');
});