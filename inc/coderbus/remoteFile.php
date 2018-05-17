<?php

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\Psr7\InflateStream;
use Kevinrob\GuzzleCache\CacheMiddleware;
use League\Flysystem\Adapter\Local;
use Kevinrob\GuzzleCache\KeyValueHttpHeader;
use Kevinrob\GuzzleCache\Strategy\GreedyCacheStrategy;
use Kevinrob\GuzzleCache\Storage\DoctrineCacheStorage;
use Doctrine\Common\Cache\FilesystemCache;

class remoteFile {

  private $file;

  public function __construct($url=null, $age = 5){
    $age = $age * 60; //Defaults to five minutes
    $stack = HandlerStack::create();
    $stack->push(
      new CacheMiddleware(new GreedyCacheStrategy(new DoctrineCacheStorage(new FilesystemCache(ROOTPATH.'/tmp/cache')),$age)),'greedy-cache'
    );
    if (!$age){
      $client = new Client([
        'headers'        => [
          'Accept-Encoding' => 'gzip',
          'User-Agent'      => "Coderbus GBP readout"
        ],
      ]);
    } else {
      $client = new Client([
        'handler'        => $stack,
        'headers'        => [
          'Accept-Encoding' => 'gzip',
          'User-Agent'      => "Coderbus GBP readout"
        ],
      ]);
    }

    try{
      $res = $client->request('GET',$url);
    } catch (Exception $e){
      die($e->getMessage());
    }
    $this->file = (string) $res->getBody();
    return $this->file;
    // $file->rewind();
    // return (string) $file->getContents();
  }

  public function __tostring(){
    return (string) $this->file;
  }

}