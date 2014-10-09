<?php
/* uncomment and then modify lines behind //// if there are images 
    with same name of different copies, i.e. "redhat-1.jpg" and "redhat-2.jpg"*/
/* uncomment and then modify lines behind //-- if there are images
    of different format other than .jpg */
?>
<?php
function csv_to_array($filename='', $delimiter=',')
{
    if(!file_exists($filename) || !is_readable($filename))
        return FALSE;

    $header = NULL;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== FALSE)
    {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
        {
            if(!$header)
                $header = $row;
            else
                $data[] = array_combine($header, $row);
        }
        fclose($handle);
    }
    return $data;
}
function imageRename($oldSid, $newSid){
    $oldName = './images/' . $oldSid;
    $newName = './images/' . $newSid;

    ////$i = 1; 
    
    $finished = false; 
    while (! $finished ) {
   
            $oldStyleImage_jpg = $oldName.'.jpg';//.jpg image
       //-- $oldStyleImage_png = $oldName.'.png';//.png image
       //-- $oldStyleImage_gif = $oldName.'.gif';//.gif image

        ////$oldStyleImage_jpg = $oldName . '-' . $i . '.jpg';
        ////$oldStyleImage_png = $oldName . '-' . $i . '.png';
        ////$oldStyleImage_gif = $oldName . '-' . $i . '.gif';

             $newStyleImage_jpg = $newName.'.jpg';//.jpg image
        //-- $newStyleImage_png = $newName.'.png';//.png image
        //-- $newStyleImage_gif = $newName.'.gif';//.gif image
        
        ////$newStyleImage = $newName . '-' . $i . '.jpg';
        ////$newStyleImage = $newName . '-' . $i . '.jpg';
        ////$newStyleImage = $newName . '-' . $i . '.jpg';
        
        if(file_exists($oldStyleImage_jpg)){
            rename($oldStyleImage_jpg, $newStyleImage_jpg);
        //--rename($oldStyleImage_png, $newStyleImage_png);
        //--rename($oldStyleImage_gif, $newStyleImage_gif);
        }else{
            $finished = true;
            break;
        }
        var_dump('FROM: ' . $oldStyleImage_jpg . ' TO: ' . $newStyleImage_jpg);
       
        ////$i++;
    }

    echo "Images no longer found moving on to the next.\n";

}

$styles = csv_to_array('styles.csv', ',');

foreach($styles as $style){

    $newSid = $style['NEWSTYLE'];
    $oldSid = $style['OLDSTYLE'];

    imageRename($oldSid, $newSid);

}



?>