<script setup>
import { Link } from '@inertiajs/vue3'
import {cart} from "../Pages/Client/cartStore.js";
</script>


<template>
    <nav class="navbar navbar-expand-lg bg-body-white shadow-sm ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Mall</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav w-100">
                    <template v-if="$page.props.user">
                        <li class="nav-item">
                            <Link class="nav-link active" aria-current="page" href="/">Home</Link>
                        </li>
                        <li class="nav-item">
                            <Link class="nav-link active" aria-current="page" href="/stores">Stores</Link>
                        </li>
                        <li class="nav-item">
                            <Link class="nav-link active" aria-current="page" href="/orders">Orders</Link>
                        </li>

                        <template v-if="$page.props.user.role == 'admin'">
                            <li class="nav-item">
                                <Link class="nav-link active" aria-current="page" href="/dashboard">Dashboard</Link>
                            </li>
                        </template>
                    </template>
                    <template v-if="!$page.props.user">
                        <div class="d-lg-flex ms-auto">
                            <li class="nav-item">
                                <Link class="nav-link" href="/auth/register">Register</Link>
                            </li>
                            <li class="nav-item">
                                <Link class="nav-link" href="/auth/login">Login</Link>
                            </li>
                        </div>
                    </template>
                    <div v-if="$page.props.user" class="d-lg-flex ms-auto">

                        <li  class="nav-item">
                            <Link class="nav-link" href="/cart">Cart ({{ cart.items.length }} items)</Link>
                        </li>
                        <li class="nav-item">
                            <Link class="nav-link" href="/auth/logout" method="post">Logout</Link>
                        </li>
                    </div>

                </ul>
            </div>
        </div>
    </nav>
    <main>
        <article>
            <slot />
        </article>

        <p class="mx-auto text-center position-relative bottom-0 start-0 end-0">Change Lang <a href="/lang/en">English</a> <a href="/lang/ar">Arabic</a></p>
    </main>
</template>
