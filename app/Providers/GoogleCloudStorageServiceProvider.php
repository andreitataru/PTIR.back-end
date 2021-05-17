<?php
namespace App\Providers;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Arr;
use League\Flysystem\Filesystem;
use App\Adapters\GoogleStorageAdapter;
class GoogleCloudStorageServiceProvider extends ServiceProvider
{
	/**
	 * Perform post-registration booting of services.
	 */
	public function boot()
	{
		$factory = $this->app->make('filesystem');
		/* @var FilesystemManager $factory */
		$factory->extend( 'gcs', function ( $app, $config ) {
			$storageClient = new StorageClient( [
				'projectId'   => $config['project_id'],
				'keyFilePath' => Arr::get( $config, 'key_file' ),
			] );
			$bucket        = $storageClient->bucket( $config['bucket'] );
			$pathPrefix    = Arr::get( $config, 'path_prefix' );
			$storageApiUri = Arr::get( $config, 'storage_api_uri' );
			$adapter = new GoogleStorageAdapter( $storageClient, $bucket, $pathPrefix, $storageApiUri );
			return new Filesystem( $adapter );
		} );
	}
	/**
	 * Register bindings in the container.
	 */
	public function register()
	{
		//
	}
}