
$onlyFile = $this->onlyFileFromUrl("www.url.com/image/file.txt");

private function onlyFileFromUrl($fileURL){
    $fileURL = pathinfo($fileURL);

    if( !isset($fileURL['filename']) ){
        $fileURL['filename'] = substr($fileURL['basename'], 0, strrpos($fileURL['basename'], '.'));
    }       
    return $fileURL;
}
