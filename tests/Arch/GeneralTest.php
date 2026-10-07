<?php

arch('php preset')->preset()->php();

arch('security preset')->preset()->security();

arch('no debugging statements are left behind')
    ->expect(['dd', 'ddd', 'dump', 'ray', 'var_dump', 'print_r', 'die', 'exit'])
    ->not->toBeUsed();

arch('env is only read inside configuration files')
    ->expect('env')
    ->not->toBeUsed();
