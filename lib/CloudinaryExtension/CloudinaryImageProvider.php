<?php


namespace CloudinaryExtension;

use Cloudinary;
use Cloudinary\Uploader;
use CloudinaryExtension\Image\Transformation;
use CloudinaryExtension\Security;

class CloudinaryImageProvider implements ImageProvider
{
    private $configuration;

    private function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
        $this->authorise();
    }

    public static function fromConfiguration(Configuration $configuration)
    {
        return new CloudinaryImageProvider($configuration);
    }

    public function upload(Image $image)
    {
        Uploader::upload((string)$image, array("public_id" => $image->getId()));
    }

    public function transformImage(Image $image, Transformation $transformation = null)
    {
        if ($transformation === null) {
            $transformation = $this->configuration->getDefaultTransformation();
        }
        return Image::fromPath(\cloudinary_url($image->getId(), $transformation->build()));
    }

    public function validateCredentials()
    {
        $signedValidationUrl = $this->getSignedValidationUrl();
        return $this->validationResult($signedValidationUrl);
    }

    public function deleteImage(Image $image)
    {
        Uploader::destroy($image->getId());
    }

    private function authorise()
    {
        Cloudinary::config($this->configuration->build());
    }

    private function getSignedValidationUrl()
    {
        $consoleUrl = Security\ConsoleUrl::fromPath("media_library/cms");
        return (string)Security\SignedConsoleUrl::fromConsoleUrlAndCredentials(
            $consoleUrl,
            $this->configuration->getCredentials()
        );
    }

    private function validationResult($signedValidationUrl)
    {
        $request = new ValidateRemoteUrlRequest($signedValidationUrl);
        return $request->validate();
    }
}
