<?php

namespace CloudinaryExtension\Migration;

interface SynchronizedMediaRepository
{
    public function findUnsynchronisedImages();
}
