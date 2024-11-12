<?php

arch()->preset()->php();
arch()->preset()->laravel();

arch('strict types')
    ->expect('App')
    ->toUseStrictTypes();
