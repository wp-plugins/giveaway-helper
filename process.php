<?php  
	global $wpdb;
	echo "<script type=\"text/javascript\">
function selectNode (node) {
var selection, range, doc, win;
if ((doc = node.ownerDocument) && (win = doc.defaultView) && typeof
win.getSelection != 'undefined' && typeof doc.createRange != 'undefined'
&& (selection = window.getSelection()) && typeof
selection.removeAllRanges != 'undefined') {
range = doc.createRange();
range.selectNode(node);
selection.removeAllRanges();
selection.addRange(range);
}
else if (document.body && typeof document.body.createTextRange !=
'undefined' && (range = document.body.createTextRange())) {
range.moveToElementText(node);
range.select();
}
}
</script>";
    if($_POST['Givehelp_hidden'] == 'Y') {  
        //Form data sent  
		$i=0;
		$post_id = $_POST['title']; 
		$email = $_POST['admin'];  
		$type = $_POST['participants'];
		$removearray = explode(",", $email);
		if ($type=='email') {
		$mylink = array_unique($wpdb->get_col("SELECT comment_author_email FROM $wpdb->comments WHERE comment_post_ID = $post_id AND comment_type != 'pingback'"));
		$result = array_diff($mylink, $removearray);
		echo '<div class="updated"><strong><h4><u><em>Emails Addresses of Participants</em></u></h4>';
		aboveloop();
		foreach ($result as $value) {
			echo '<li>' . $value . '</li>';
			$i++;
		}
		belowloop ();
		}
		
		else {
		$mylink = array_unique($wpdb->get_col("SELECT comment_author FROM $wpdb->comments WHERE comment_post_ID = $post_id AND comment_type != 'pingback'"));
		$result = array_diff($mylink,$removearray);
		echo '<div class="updated"><strong><h4><u><em>Names of Participants</em></u></h4>';
		aboveloop();
		foreach ($result as $value) {
			echo '<li>'.$value.'</li>';
		}
		belowloop ();
		}
	}
 else {  
        //Normal page display  
    }  

function aboveloop () {
		echo '<ol><div id="select">';
}

function belowloop () {
		echo '</div></ol></strong><p class="submit"><input type="button" value="Select All" onclick="window.selectNode(document.getElementById (\'select\'));">&nbsp;<a href="http://www.random.org/lists/" target="_blank"><input type="button" value="Goto List Randomizer"></a> </p> </div>';
}
?>

 
<div class="wrap">  
    <?php    echo "<h2>" . "Giveaway Helper" . "</h2>"; ?>  
  
<form method="post" enctype="multipart/form-data" name="form1" target="_self" id="form1">  
	<input type="hidden" name="Givehelp_hidden" value="Y">  
	<?php    echo "<h4>" . "Enter details" . "</h4>"; ?>
1. Select Post : 
<select name="title">
<?php
global $post;
$args = array( 'numberposts' => 30, 'offset'=> 0 );
$myposts = get_posts( $args );
foreach( $myposts as $post ) :	setup_postdata($post); ?>
	<option value="<?php echo $post->ID; ?>"><?php the_title(); ?></a></option>
<?php endforeach; ?>
</select>

<p>2. Enter Email ID's you want to remove separated by <em>comma</em> (optional): <input type="text" name="admin"> </p>

<p><em>E.g :</em> email1,email2,email3. Separate emails by comma only, don't add spaces or any special characters in between emails.  </p>
<p>3. I want to retrieve : <input type="radio" name="participants" value="email" /> Email Addresses <input type="radio" name="participants" value="name" /> Names</p>

<p class="submit"> <input type="submit" value="Submit"> </p> 


    </form>  
</div> 

