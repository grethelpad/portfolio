<?php


function makeASentences(){
	# setting total_words for testing purposes - need to create form input
	$total_words = rand(5, 15);
	
	# create array with at least 100 words - mine only has 40. Be sure to include other common sentence words
	$word_list = array("puggie", "pampered", "snuggles", "sweetest", "saucy", "cutest", "clever", "wiggly", "mischievous", "little classic", "chubby little", "dearest sweetest", "little cheerful", "playful", "noble", "bone", "bowl", "paws", "floppy", "adorable", "pupper", "puggy", "bark", "puggo", "waggy", "tail", "loaf", "rolls", "cuddle bug", "snoring", "puperino", "woofy woof", "fluffy", "frumpy", "squishy", "sleepy", "fatty", "noddle", "softest ears", "stuborn", "quick", "playful", "tender", "love", "joy", "caring", "amiable", "sniffy", "bright", "clever", "foodie", "alert", "pal", "always hungry", "beloved", "glossy coat", "sleek", "rose ears", "smushed face", "puppy energy", "thiccccck", "magestic", "the", "at", "there", "some", "my", "of", "be", "use", "than", "and", "a", "to", "in", "is", "you", "that", "it", "he", "pugs", "for", "on", "are", "with", "his", "puggie pugs pug", "i", "said", "part", "made", "come", "can", "were", "all", "about", "many", "could", "no", "yes", "by", "there", "their", "they're", "look", "now", "into", "playing", "seem", "pugle", "tell", "give", "think", "ride", "stand", "dance", "fight", "laugh", "cry", "listen", "open", "close", "eat", "jump", "crawl", "are", "with", "his", "they", "i", "said", "part", "made", "come", "wait", "smell", "snore", "bathe", "shake", "kiss", "hug", "climb", "bow", "come");
	
	# find out the total number of items in my list to use for my random index picker
	$tot_word_list = count($word_list);
	
	# initialize my sentence to nothing before i start creating it
	$this_sentence = "";
	$x = 0;
	
	# now loop through the $total_words amount of times to create random words from my array
	while($x < $total_words) {
	
	#randomly select an array index to PICK a word from our word list
	# note that I am subtracting one since the word count is 1 more than the index since we start at 0
	$this_index = (rand(0,($tot_word_list-1)));
	
	# add the new string onto the existing string 
	$this_sentence = $this_sentence . " " . $word_list[$this_index];
	
	#increment our loop counter
	$x++;
	}
	
	# using two string functions here - trim which will remove any white space from the beginning or end of the string
	# and ucfirst which will capitalize the first letter. Note that I am also add a period at the end.
	return ucfirst(trim($this_sentence));
}

function makeAParagraph() {
	$paragraph = '';
	$total_sentences = rand(3,7);
	$i = 0;
	while($i < $total_sentences) {
		$paragraph .= makeASentences(). '. ';
		$i++;
	}	
	
	return $paragraph;
}

$loremIpsum = '';
$z= 0;
$total_paragraphs = intval($_POST['paragraph']);
while($z < $total_paragraphs){
	$loremIpsum .= '<p>' . makeAParagraph() . '</p>';	
	$z++;
}
?>	



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!--CSS Style Sheet-->
    <link rel="stylesheet" href="pug.css">
     <!--Google Font-->
    <link href="https://fonts.googleapis.com/css2?family=Arimo:ital,wght@0,400;0,700;1,400;1,700&family=Pacifico&display=swap" rel="stylesheet">
    <!--fontawesome-->
<script src="https://kit.fontawesome.com/a65682b47f.js" crossorigin="anonymous"></script>
    <title>Puggie ipsum</title>
</head>
<body>
  <header>
    <h1>Puggie Ipsum</h1>
  </header>
  <div class="wrapper">
  	 <div id="paragraphs" class="paragraphs">
  	 	<h2>Pugtastic Text!</h2>
    		<p>
				<?php 
					echo $loremIpsum;
				?>
				</p>
    </div>
     <a href="index.html"> 
     <button class="bone">
    <div class="c1"></div>
    <div class="c2"></div>
    <div class="c3"></div>
    <div class="c4"></div>
    <div class="b1">
      <div class="b2">
       Redo
      </div>
    </div>
</button>
   </a>
   
  </div>
  <footer>
    <div class="icons">
    <i class="fas fa-dog"></i>
    <i class="fas fa-bone"></i>
    <i class="fas fa-paw"></i>
    </div>
  </footer>
</body>
</html>
