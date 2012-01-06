<?php

/**
 * READER FUNCTIONS
 *
 * This file allows you to add functions and plain procedures that will be
 * loaded every time the public reader loads.
 *
 * If this file doesn't exist, the default theme's reader_functions.php will
 * be loaded.
 *
 * For more information, refer to the support sites linked in your admin panel.
 */


function build_board_comment($p, $modifiers = array(), $thread_id = NULL) {
	$CI = & get_instance();
	ob_start();
?>
	<table>
		<tbody>
			<tr>
				<td class="doubledash">&gt;&gt;</td>
				<td class="<?php echo ($p->subnum > 0) ? 'subreply' : 'reply' ?>" id="p<?php echo $p->num . (($p->subnum > 0) ? '_' . $p->subnum : '') ?>">
					<label>
						<input type="checkbox" name="delete[]" value="<?php echo $p->doc_id ?>"/>
						<span class="postername"><?php echo (($p->email_processed && $p->email_processed != 'noko') ? '<a href="mailto:' . form_prep($p->email_processed) . '">' . $p->name_processed . '</a>' : $p->name_processed) ?></span>
						<?php if ($p->trip_processed) : ?>
							<span class="postertrip"><?php echo $p->trip_processed ?></span>
						<?php endif; ?>
						<?php echo date('D M d H:i:s Y', $p->timestamp + 18000) ?>
					</label>
					<?php if($thread_id == NULL) : ?>
					<a class="js" href="<?php echo site_url(array($CI->fu_board, 'thread', $p->parent)) . '#p' . $p->num . (($p->subnum > 0) ? '_' . $p->subnum : '') ?>">No.<?php echo $p->num . (($p->subnum > 0) ? ',' . $p->subnum : '') ?></a>
					<?php else : ?>
					<a class="js" href="<?php echo site_url(array($CI->fu_board, 'thread', $p->parent)) . '#p' . $p->num . (($p->subnum > 0) ? '_' . $p->subnum : '') ?>">No.</a><a class="js" href="javascript:insert('>><?php echo $p->num . (($p->subnum > 0) ? ',' . $p->subnum : '') ?>\n')"><?php echo $p->num . (($p->subnum > 0) ? ',' . $p->subnum : '') ?></a>
					<?php endif; ?>

					<?php if ($p->deleted == 1) : ?><img class="inline" src="<?php echo site_url().'content/themes/'.(($CI->fu_theme) ? $CI->fu_theme : 'default').'/images/icons/file-delete-icon.png'; ?>" alt="[DELETED]" title="This post was deleted from 4chan manually."/><?php endif ?>
					<?php if ($p->spoiler == 1) : ?><img class="inline" src="<?php echo site_url().'content/themes/'.(($CI->fu_theme) ? $CI->fu_theme : 'default').'/images/icons/spoiler-icon.png'; ?>" alt="[SPOILER]" title="This post contains a spoiler image."/><?php endif ?>
					<?php if ($p->subnum > 0) : ?><img class="inline" src="<?php echo site_url().'content/themes/'.(($CI->fu_theme) ? $CI->fu_theme : 'default').'/images/icons/communicate-icon.png'; ?>" alt="[INTERNAL]" title="This is a ghost post, not coming from 4chan."/><?php endif ?>

					<?php if(isset($modifiers['post_show_view_button'])) : ?>[<a class="btnr" href="<?php echo site_url(array($CI->fu_board, 'thread', $p->parent)) . '#p' . $p->num . (($p->subnum)?'_'.$p->subnum:'') ?>">View</a>]<?php endif; ?>

					<br/>
					<?php if ($p->media_filename) : ?>
					<span>
						File: <?php echo byte_format($p->media_size, 0) . ', ' . $p->media_w . 'x' . $p->media_h . ', ' . $p->media; ?>
						<?php echo '<!-- ' . substr($p->media_hash, 0, -2) . '-->' ?>
					</span>
					[<a href="<?php echo site_url($CI->fu_board . '/image/' . urlencode(substr($p->media_hash, 0, -2))) ?>">View Same</a>] [<a href="http://iqdb.org/?url=<?php echo $p->thumbnail_href ?>">iqdb</a>] [<a href="http://google.com/searchbyimage?image_url=<?php echo $p->thumbnail_href ?>">Google</a>] [<a href="http://saucenao.com/search.php?url=<?php echo $p->thumbnail_href ?>">SauceNAO</a>]
					<br>
					<a href="<?php echo ($p->image_href)?$p->image_href:$p->remote_image_href ?>" rel="noreferrer">
						<img class="thumb" src="<?php echo $p->thumbnail_href ?>" alt="<?php echo $p->num ?>" width="<?php echo $p->preview_w ?>" height="<?php echo $p->preview_h ?>" />
					</a>
					<?php endif; ?>
					<blockquote>
						<p><?php echo $p->comment_processed ?></p>
					</blockquote>
				</td>
			</tr>
		</tbody>
	</table>
<?php
	$string = ob_get_contents();
	ob_end_clean();
	return $string;
}

// Fuuka's Code
function fuuka_title()
{
	$titles = array('That was VIP quality!', 'That was /b/ Quality! Please die in a fire~', 'Can\'t let you do that, Star Fox!');
	return $titles[array_rand($titles, 1)];
}

function fuuka_message()
{
	$messages = array('　　　人　　　　　
　　（＿_）　　　　
　 （＿＿）　　　
　（ ＿＿ ）　　　　
　（　・∀・）　＜　My name is Squeeks and this site sucks dick like the rest of those
　（つ　　 つ　 wannabe "I\'ve got nothing to do so I\'ll make a 4chan copy" sites.
　｜ ｜　|　　
　（_＿）＿）', '　　 　 　 　 　r‐､　　 __ __
　　 　 　　 ／　　￣｀ヽ　/
　　　　　 // /　　　、　V}
　　　　　 N从ﾘハヽハ　iﾊ
　　　　　 / ic＞　＜c| ｌ|ｲ〉　　Here comes a candle to light you to bed!
　 　 　　んへ　i￣!　ﾉ从j　　　　　Here comes a chopper to chop off your head!
　　　　　　 /⌒Y⌒`ヽヽ.', '　　　　　　　　　 jvィﾍrくｰz_　
　　　　　　　　 　Z 　 　r､、 ㌦
　　　　　　　　 　ｲrﾍ＜,_ ｀ﾞﾌ
　　　　 　 　　　　}以 ｰ　 r/　　　　　　　I am the 1000 of my GET.
　　　　　　　　　rくト､ヽ‐／　　　　　　　　VIP is my body, and kopipe is my blood.
　　　　　　　r＜＼_〕lﾆﾆ〕ｽｰ-　_　　　　　I have created over 999 posts.
　　　　　　f⌒ヽ　N＼_人｀Y＞ト､ lﾊ　　　　Unaware of /b/.
　　　　　　|　　　ヽ、　 　 〉 l　 l　 Y l　　　　Nor aware of fchan.
　　　　　　|　　　　ﾘ　　 / .人_ V　}lｲ　　　　Waiting for one\'s arrival.
　　　　　　l　　　 ｲ 　／ノィ⌒ヽトｲ {　　　I have no regrets, this was the only path.
　　　　　　|　　　 r＜（　 （　ｯ､ﾉ　｝ l|　　　My whole life was Unlimited Troll Works.
　　　　　　ﾄ､　　∧｀　ｰt-<⌒>-ｲ　l
　　　　　　lﾊヽ 〈　〕､＿ﾉ＞(__ﾉイｰ l|
　　　　　　〈　　ゝl /　 　 　 〕-―lｭ　ﾊ
　　　　　　l　 　 lｲﾌﾌ＞イ二ニ =｢ﾄ〈l
　　 　　　 |　V.│　 ／　!|八イ　l| ヽ　　
　　　　　　 !　 V.! ／　 　 lｲ〈ﾉ／ﾉ　 l
　　 　　　　lﾊ　ヽ　　　 　 ﾄノ∠　 l　 l
　　　　　　 l　V　l　　　 　 l〕＼　 ∧　\',
　　　　　　 l⌒ヽ人　　　　 lー----｡l　 \',
　　　　　　 ﾄ､_丿 ｢〕　　 　 lー―‐〆l 　 !
　　　　　　 `ﾍﾍﾍj　　 　 　 l　　／／l　　!', '　　　 　　　∧＿∧
　　　　 　 （ ｀ハ´ ）＜Huh!?　
　　　 　 　 /　　ノ⌒⌒⌒`～､
　　　(￣⊂人　//⌒　　 ﾉ　　 ヽ）
　　⊂ﾆﾆﾆﾆﾆﾆﾆﾆニニニニニﾆ⊃

　　　　　　　　　　　　 ∧＿∧
｀｀)　　　　　　　　　　（　｀ハ´）
　 ｀)⌒｀)　　　　　　⊂　　⊂ ）
≡≡≡;;;⌒｀)≡≡≡〈　〈＼ ＼
　　　　　;;⌒｀)⌒｀)　 （＿_）（＿_）

　　　　　　　 　∧＿∧　　　┌────────────
　　　　　　 ◯（ ｀ハ´ ）◯ ＜ I just wanted to post this!
　　　　　　　 ＼　　　 ／　　└────────────
　　　　　　　_／ ＿＿ ＼_
　　　　　　（＿／　　 ＼＿）
　　　　　　　　 　　ｌｌｌ', 'ｶﾞｯ　　　 ∧__∧　 ∩ Mind your place, child!
　　　　　（,,｀ハ´)彡☆
　　　　　　⊂彡☆))∀・) <ow ow sorry ow sorry ow ow', '  Hey >>2, do you know what happed? Oh, by the way, this is nothing to do with
  this thread. I went to Yoshinoya the other day. YOSHINOYA! And there were
  so crowded and I couldn’t even find a place to sit. Then, I found the
  advertising saying “150 yen off!.” My goodness! How come you are all coming,
  and sitting at Yoshinoya for just “150 yen off?” I saw a familie, like four
  of them with their kids. This guy’s saying “All right, your dad is ordering
  an extra large bowl.” What a pathetic! Hey you bastards. I can give my 150
  yen. So, just give me a break alright? Yoshinoya should be a place where
  people are fighting, like two jerks facing on each other against “U shaped
  table,” then one of them can be stubbed to death by any chance. This is how
  Yoshinoya’s suppose to. This ain’t a place for no woman and no kid. Alright,
  I finally found a place to sit. Then, the jerk next to me was ordering a
  large size with putting extra juice on it. That pissed me off once again.
  Hey jerk, we ain’t order “putting extra juice on a bowl” no more today!
  What a stupid you looked: ordering extra juice with his goofy face! Do you
  really want to eat a beef bawl with extra juice on it? I really want to ask
  you, interrogating you for an hour. Don’t you just want to say “an extra
  juice!?” As a professional Yoshinoya customer, I would rather order “extra
  scallions.” This is the coolest way. You get more scallions, and less beefs.
  This is it! It can be the best, if you put a raw egg on it. No one can beat
  this. But you have to be careful because if you order this way, the Yoshinoya
  employees gonna put you on their black lists. This can be so dangerous,
  like a risk of fighting with a double edged blade. So, I don’t recommend
  the beginners to do this... >>2, you’d rather ordering some ordinary set menu
  instead.', ' [No]
　　　-‐‐- 、
／　　　　　ヽ
!　 !　人|,.iﾉl_ﾉ）
i 　乂-‐　－! i　 Don\'t think, feel and you\'ll be in your room.
＼ヽ .ゞ　- ﾉノ 　
　　｀｀フ　i´
　 　 / ＼ﾉゝ
　　/__i |丱!|
━━つ━つ━━∞∞∞========
==　　　The Tanas∴∵∴∵ Inn　　　　==
∞∞∞∞∞∞∞∞∞∞∞∞∞∞', '　 Λ__Λ
　（　ﾟ mﾟ） I\'m not into the whole replying thing.
　（　　　）', '　 Λ__Λ
　（　ﾟ mﾟ） I\'m not into the posting when i feel like it thing.
　（　　　）', '\'\'\';;\';\';;\'\';;;,.,　　　　　　　　　　　　　　4chan
　　　\'\'\';;\';\'\';\';\'\'\';;\'\';;;,.,　　　　　4chan
　　　;;\'\'\';;\';\'\';\';\';;;\'\';;\'\';;; 　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　
　　　　;;\'\';\';\';;\'\';;\';\'\';\';\';;;\'\';;\'\';;;
　　　　　 vymyvwymyvymyvy　　　　　4chan
4chan 　　　n_n,n_n、n_n,n_n、n_n,n_n、
　　　　　　∩＿∩＾－＾∩＿∩＾－＾∩＿∩＾－
　　4chan　　∩＿＿∩　∩＿＿∩　∩＿＿∩　∩＿＿∩
　　　　　　　　　∩＿　∩＿＿∩　∩＿＿∩　＿∩　∩＿　　4chan
　　　　　∩＿＿＿∩　　　　∩＿＿＿∩　∩＿＿＿∩　∩＿＿＿∩
　　　　　| ノ　　　　　 ヽ　　 | ノ　　　　　 ヽ | ノ　　　　　 ヽノ　　　　　 ヽ
　　　　 /　　●　　　● |　/　　●　　　● |　　●　　　● |　●　　　● |
　　　　|　　　　( _●_)　 ミ |　　　　( _●_)　 ミ　　( _●_)　 ミ 　( _●_) ミ
　　　 彡､　　　|∪|　　､｀ 彡､　　　|∪|　　､｀＼　|∪|　　､｀＼　|∪|　､｀＼
　　　/　＿＿　 ヽノ　/ /　＿＿　 ヽノ　/´>　 ) ヽノ　/ ノ　//ヽノ/´>　 )
　　　(＿＿＿）　　　/　(＿＿＿）　　　/　(／＿）　　 /　(／ 　　/　(_／', '＼Violence always fascinates me!／
　.￣￣￣￣|/￣￣￣￣￣￣￣￣　　.＿ ／-　イ､_
　　　　　　　　　　 ＿＿　　　　　 　　／: : : : : : : : : : : (
　　　　　　　　　 〈〈〈〈　ヽ　　　　　/: : : : ::;:;: ;: ;:;: ; : : : ::ゝ
　　　　　　　　　　〈⊃　　}　　　　　{:: : : :ノ　--‐\'　､_＼: : ::｝
　　 ∩＿＿＿∩　 |　　 |　　　　　 {:: : :ノ ,_;:;:;ノ､ ェｪ ヾ: :::}
　　 | ノ　　　　　 ヽ !　　 !　　　、　　ｌ: :ﾉ　／二―-､　|: ::ﾉ
　　/　　●　　　● |　　/　　　，,･_　　|　/／　 ￣7/ /::ノ
　 |　　　　( ●_)　 ミ／　, ’,∴ ･　¨　 〉(二─-┘{／
　彡､　　　|∪|　　／　　､･∵ ’　　／､／/|　￣￣ヽ
/　＿＿　 ヽノ　/　　　　　　　　 ／　　 //　|／／＼ 〉
(＿＿＿）　　　/　　　　　　　 　/　　　 //　　 /＼ ／', '　　　　.,. -──-､　　　　＿＿
　　 ／. : : : : : : : : :＼　 〈〈〈〈　ヽ
　 /.┛┗: : : : : : : : : :ヽ 〈⊃　　ﾉ
.　!.::┓┏,-…-…-ミ: ::\',　|　　 |　　　　　　　∩＿＿＿∩
　{::: : : : :i \'⌒\'　 \'⌒\'i: : ::}ノ　　 !　　　　　　　| ノ --‐\'　 ､_＼
　{:: : : : : |　ｪｪ　 ｪｪ |: : :}　 　/　　　、　　　/　,_;:;:;ノ､　　● |
.　{ : : : : :|　　　,.　　 |:: :;!　／　, 　　，,･_　 |　　　　( _●_)　 ミ
.　ヾ: : :: :i　r‐-ﾆ-┐| ::ﾉ／　　　, ’,∴ ･　¨彡､　　　|∪|　　ミ
　　　ゞイ!　ヽ 二ﾞノｲゞ　　　　　､･∵ ’　　／　　　 　ヽノ￣ヽ
　　/　＿ `　ｰ一\'´￣/　　　　　　　　　 ／　　　　　　　／＼ 〉
　　(＿＿＿）　　　　/　　　　　　　　　 /　　　　　　　 /', '　　へ＿＿＿_ﾍ　
　　|ノ　　 　　　ヽ　　
　 ｜　´　　 　 ｀ |　.
　　ﾐ *　____ｰ__　ﾐ
　　|　 │・ω・ |│　< So, this is the place for the furchan meetup?
　　| ＿ ￣￣￣_|　　　　
　　| ∪　　　　 ∪　 　
　　＼__　　 　 _/　　　　
　　　　∪￣∪', '　　 へ-ﾍ
　 ﾐ* ´ｰ｀ﾐ I\'m not on your head, nya.
～(,_ｕ ｕﾉ', '　　　　 ∧＿∧
　ﾋﾟャｰ<　｀ェ´> ＜Sorry im late, was busy bringing kimchi, nida.
　　＝〔~∪￣￣〕
　　＝ ◎――◎', '　　　　　　　　　　　 ∧＿∧
　　　　　∧＿∧ 　（´<_｀ 　） Did you really have to bring the PC with you
　　　　 （　´_ゝ`）　/　　 ⌒i
　　　　／　　　＼　 　　　|　|
　　　 /　　 　/￣￣￣￣/　|
　 ＿_(__ﾆつ/　 　　　　 / .| .|＿＿＿＿
　 　　　 ＼/＿＿＿＿/　（u　⊃', '. /　 | /　 / /　 ／　 /　／／ / ﾊ.　　　　ヽ　　　 ヽ. ＼
/\' 丁|\'　　ｉ　l ／　　 /／／　〃/　 ＼￣ ＼!　　　　 |＼|
＼/ j|　　,レ\'　＿ ／ ／./／/./　 ＿　＼　 |＼.　｜ |／
. /__」ヒ.´_彡\'_＞=,ニドノ\'　 //　　\'ァ,.\'ニ=＜}　\'　　|　|　
/　 ｛{￣　{　＼　Ｐ⌒!i　　//　　　　P⌒!i ノ ,\' 　 /! /
,/　 {ﾊ..　　＼__, ゞ冖＾　 /\'　!　　　　￣＾` ブ　／//
　　 ﾊ. ＼　　 く　　　　　　　　 　 　 __　 ∠ イ ,ノ\'
　 ,/ ,ﾊ　7`ト　_,＞　　　　 　 ＿_,. イ !　　 /〃/ < I\'ve got something to put in you
f´￣ヽ ヾ、\'.{}ﾍ. 　 　 `\'マ二..＿_ ／　　　/{}ヽ》 \ I\'ve got something to put in you
_) ＞┴=く¨ヽ　ヽ.､ 　 　 　 --　　　　 , ｲ　　 }} \ At the gay bar
／　 \'´　　 ＼ﾚ-､V__.　、　 　 　 _,. イ/{{ヽ{}/《
　 .\'　　　　　　`て{ ヽ＼ `　 -- /　　/ {{-- －}}
　\'　　　　\'　　　 __j|　,ﾍ ＼.　　∧_／　 {{ /{}ヽ }}
,\'　　　　,\'　　　（_　|ヽ{i,ﾊ 　 ヽ､｣.　 ＼　{{.　　　 }}
　　　　,\'　　　　　〕|__ __ |／.,二ｆ丑:‐ ､＼{ ヽ {} /}}
　　　　　　　　 （　}}/{}ヽ|／　 /ﾊ ｢ ＼ヽ|{ ー i ‐.}}', '　 ∧＿∧　　　∧＿∧　　　∧＿∧　　 ∧＿∧　 　 　　∧＿∧
　（　・∀・） 　 （　｀ー´）　　（　´∀｀）　 （　ﾟ ∀ﾟ ）　　　 （　＾∀＾）
　（　　　　つ┳∪━━∪━∪━━∪━∪━∪━┳⊂　 　 　つ
　｜ ｜　|　 ┃Save hundreds on car insurance!┃　｜ ｜ ｜
　（_＿）＿） ┻━━━━━━━━━━━━━━┻　（_＿）＿）　　　　　@gay.ru', '　 　 　 　 　 __,、
　　 　 ,r\'{ 　 ｰ､ヽ
　　　　＼＼　　Ｖ＼
　　　　　 ｀\'く｀ ｰ,ゝ⌒ヽ　　 fﾞi
　　　　　　　 ｀Ｙ_ _,.r\'⌒ヽ　_l.」
　　　　　　.__ └--ｔ_: : : : :辷v′
　　　　　　ヾ｀ﾆ._ーr\' :r\'´〕{ ｀f- ､　　 r
　　 　 　 　 　 　 ￣｀¨`￢\' {´:.:.:.:Yjｰ\'}
　　　　　　　　　　　　　,　 Ytj､:.:.:ﾉf‐\'′
　　　　　　　　　　　 　 ヾ=\'イｧ‐\'', '　　　　　　　　　　　　　 ,r=ヽ、　　　　　　　　　　　　r\';;;:;:;;:::;;;;;;;;;;;;ヽ、
　　　　　　　　　　　　　j｡ ｡ﾞLﾞi　　　　 rﾆ二`ヽ.　　　Y",,..、ｰt;;;;;;;;;;;）
　　　　　　　　　r-=、　l≦ ﾉ6)＿　　　l_,.､ヾ;r､ﾞt　　 lｦ \'・=　 ）rテ-┴- ､
　　　　　　　　　｀ﾞゝヽ、`ｰ!　ﾉ::::::｀ヽ､ L､ﾟﾞ　tﾉ`ｿﾞ`ｰ ﾞiｰ\'　 ,r"彡彡三ﾐミ｀ヽ
　　　　　　　　　　にｰ `ヾヽ\'":::::::::::: ｨ"^ﾞiﾌ　 _,,ﾉ　,　　ﾞtﾌ　ﾞゞ\'\'"´　　 ﾞifrﾐソﾍ,
　　　　　　　　　,.、　｀~iヽ､. ｀~`\'\'"´　ﾞt　（,,￣,　frﾉ　　 ゝ-‐,i ,,.,...、　 ヾミく::::::l
　　　　　　　　　ゝヽ、__l::::ヽ｀iー- \'\'\'"´ﾞi,　ヽ　ヽ,/　　　/　　lｦ ｪ｡､　　 〉:,r-､::ﾘ
　　　　　　　　　W..,,」:::::::::,->ヽi\'\'"´::::ノ-ゝ ヽ､_ﾉｰ‐ﾃ-/　i　/ ,, 、　　 \'"fっ)ﾉ::l
　　　　　　　　　　￣r＝=ミ__ｨ\'{-‐ﾆ二...,-ゝ、\'″ ／,/｀ヽl : :`i- ､ヽ　　,.:ﾞ\'\'" )\'^`\'\'ｰ- :、
　　　　　　　　　　　 lﾐ､　　／ f´　 r\'\'/\'´ミ)ゝ^),ノ>\'\'"　 ,:ｲ`i /i､ヲﾞi　.:" ,,.　/;;;;;;;;;;;;;;;;;;;｀ﾞ
　　　　　　　　　　　 !　ヾ .il　　l　　l;;;ﾄ､つノ,ノ ／　　 ／:ﾄ-"ﾉﾞi　　,,.:ｨ\'"　/;;;;;;;;;;;;;;;;;;;;;;;;;
.　　　　　　　　　 　 l　　　ハ.　l　　l;;;;i _,,.:イ　/　　 ／ 　,ﾚ\'\'";;;;｀ﾞﾞ" ヽ_,,ノ;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
　　　　　　　　　　 人 ヾﾆﾞi　ヽ.l　 yt,;ヽ　 ﾞv\'′ ,:ｨ"　　/;;;;;;;;;;;;;;r-\'"´｀i,;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
　　　　　　　　　 r\'"::::ゝ､_ﾉ　　ﾞi_,/　 l ヽ　　ﾞ\':く´　_,,.〃_;;;;;;;;;;;;f´\' 　 　 ll;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
　　　　　　　　　 ｀￣´　　　　 ／　　l　 ヽ　　　ヾ"／　 ｀ﾞ\'\'ーハ.　　 　 l;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
　　　　　　　　　　　　　　　 ／　　　 l　　ﾞt　　　 `\'　　　　 ／^t;＼　　,,.ゝ;;;;;;;;;;;;;;;i;;;;;;;;;;;;', 'Golly, have a look at the time!
　 　　　 　　　　　 　　/ヽ　　　　　　 /ヽ
　　　　　　　　　　　　/ 　ヽ　 　　　 / 　ヽ
　　＿＿＿＿＿＿ / 　 　 ヽミミ/　 　 　ヽ
　|　＿＿＿＿　／　　　 　 　 　　　:::::::::::::::＼
　| |　　　　　　 ミ　〇 ＿__　　　〇　　　　:::::::::::::::彡
　| |　　　　　　ミ　　　|　　 |　　　 　　　　 ::::::::::::::彡
　| |　　　　　　.ミ:　　|　　　|　　　　　　　　:::::::::::::::彡
　| |　　　　　　 ミ:　├―-┤　　　　.....:::::::::::::::::::彡
　| |＿＿＿＿　ヽ　　　　　　.....:::::::::::::::::::::::<
　└＿＿＿／￣￣　　　　　　　:::::::::::::::::::::::::彡
　　|＼　　　 |　　　　　　　　　　　　:::::::::::::::::::::::彡
　　＼ ＼　　＼＿＿＿　　　　　　 :::::::::::::::::::::::彡', '　　　　　__　 ,-､　__
　　　　 |_ 〉　l_ | |_ 〉
　　,-､. |;; |　|;; | |;; ｌ
　　|_ |. |;; |　|;; | |;; |　　　　　　　　　　　／|　　　　　　　　　　　　　　　
　　|;; |. | ;;V　 ;;V　|　/^〉　 　　　　　／ / .|　　　　　　　　　　　 ／|　
　　|;; \'/ 　　　　　;;|ノ　 〉　　　 　 ／;;;;\'ー |＿＿＿　　　　　　／/ |
　　|;;　　　　　 ;;;;/⌒　|　　　　 ／;;;;;;;;;;　　　 ＿_　~―-､＿／　\'ｰ |
　　|;;　丶　　;;;;/ 　　　〉　　　/;;;;;;;;;;;;;;;;;;;;;　r\';; 　;;ヽ.ヽ ! / ｒ―-､ 　|　　　　　　 　　,-､
　　|;;;;　 ｌ 　　|　　 　 /　　　 |;;;;;;;;;;;;;;;;;;　　|!!;; Ｏ;;!〉|llllll| |;;;; ｏ ;;;|　 〈　　　　 　l;;ヽ |;; l l;;ヽ
　　>;;;;;;　　　　　　／　　　　|;;;;;;;;;;;;;;;;;　 -　`ー-‐\'　 ||||| ヽ＿ _,!　　|　　　 　 .ｌ;;~| |;~| .|;~| .,-､
　 /;;;;;　 　　　 ／　　　 　 　|;;;;;;;;;;;;;;;　/ |ヽ＿＿＿＿＿__,､　　　　| 　 　　 　.|;;~| |;~| .|;~| .|;-|
.　l ;;;　　〉　　｜　　 　 　　 |;;;;;;;;;; 　　 | | ~ | ｜｜ ｜｜ |　|　　　 | 　 　〈^ヽ |;; V;; 　V;; | .|;~|
.｜;;;　　! 　　｜　 　　　＿|;;;;;;;;;;;　　　 | ー |/`ｰ\'`ｰ\' Vー\' |　　　　|　　　〈;; |_」;;　　　　　 ヽ\'　|
｜;;;　 　 　 　｜　　 ／;;;;;;;;;;;;;;;;;;;; 　　 | 　　　　　　　　　　 | 　　　| 　　　 |;;; ⌒ヽ;;;;　　 　　　 |
｜;;;　 　 　 　　|　 ／;;;;;;;;;;;;;;;;;;;;;　　 　| 　　　　　　　　 　　|　　 　|　　　　〈;;; 　　 ヽ;;;;　　 /　 |
|;;;;;　　　　　　　 し\';;;;;;;;;;;;;;;;; 　　　　i　 | 　　　/~⌒!⌒)　＜ I CAME!!！
|;;;;;　　　 　　 　;;;;;;;;;;; 　　　 　　＼ |　 |　　 /　￣ｌ￣|　　　| 　|／＼　　　　 ＼;;;　　 　　　　ノ
|;;;;　　 　　　 　 　　　　　　　 　　　.|　 |　 /　　　!　 |　　 　|　| 　　 ＼　 　　　;;iiiiii　 　　 イ
|;;;;; 　　　　　　 　　 　 　　　　　　　|　 |　__ /| ＿ ＿ ∧_ .|　 | 　　　 ＼ 　　 〉;;;;;; 〉　　　　l
ヽ;;;;　　　　　　　　 　　　　　　　　　 |　 | |　|　|　｜　｜｜||　|　　　 　 ヽ　　/;;;;;　　　　　 |
　 .＾‐-;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;　　 　　　　　 ヽ 　￣￣￣二二￣￣ノ　　　　　　＼ノ;;;;; 　 　　　　 |
　　　　　　　　　　ヽ;;;;;;;;;　　　　　　　　`ー――――――\'　　　　　　　　　　　　 　　　　　|
　　　　　　　　　　　〉;;;;;;;　　　　　　　　　　　　　　　　　　　　　　　ノ;;;　　　　　　 　　　　　|
　　　　　　　　　　　|;;;;;;　　　　　　　　　　　　　　　　　　　　　　　 |;;;　　 　　　　　　　　　/
　　　　　　　　 　　|;;;;;;;　　　　　　　　　　　　　　　　　　　　　　　 |;;;　　　　　　　 　　　 ノ
　　　　　　　　　　|;;;;;;;;　　　　　　　　　　　　　　　　　　　　　　　 .|＼＿＿＿＿_＿＿／', '　 　 　!ヽ、　　　　　/　ヽ,
　　 　 |.　 ＼-─\'\'"´　　 \'i.
　　　　l　　　　　　　　　　 `､
　　　 /　 　 　 　 　 　 　 　 \'i,
　　　 |　 　 　 　､_,,.. -ｲ　○＋　　　　　 I CAME!
　　　＋.　 　 ○　 ヽ、ﾉ　　 ,ﾒ
　　 /´メ.、　　　　　´ _,,...-‐\'\'⌒ヽ
　 　ヾ､,,_　　　　　　　　　　　　　ﾉ
　　　　　〉　　　　　　　　_,,.. -‐\'\'´
　　（（　/γ⌒ヽ　　　 　 /
　　　　i\'　ヽ,,_,,.ﾉ　 　 　 （
　　　　ヽ　　　､　　 　　　\'i,
　　　　　,ゝ　　,>　　 　 　ﾉ
　　　 　（　 　/　　　　　〈
　　　　 　ヽ,_,i　　　　　　）
　　　 　　　　 `\'\'ー-─\'\'"', '　　　　　　　　　　　　_　　-───-　　 _
　　　 　 　 　 　 , 　\'´　　　　　　　　　　　｀ヽ
　　　 　 　 　 ／　　　　　　　　　　　　　　　　 ＼
　　　　　 　 /　　　　　　　　　　　　　　　　　　　 ヽ
　　　　　　/　__, ィ_,-ｧ__,,　,,､　　, ､,,__ -ｧ-=彡ﾍ　 ヽ
　　　　 　 \'　「　　　　　　´　{ハi′　　 　　 　 　 }　 l
　　　　　 |　 |　　　　　　　　　　　　　　　　　　　 |　 |
　　 　 　 |　 !　　　　　　　　　 　 　 　 　 　 　 　 |　 |
　　　　　 | │　　　　　　　　　　　　　　　　　　　〈 　 !
　　　　　 |　|/ノ二__‐──ｧ　　 ヽﾆニ二二二ヾ } ,\'⌒ヽ
　　　　 /⌒!|　 =彳ｏ｡ﾄ￣ヽ　　　　　\'´ !o_ｼ｀ヾ　| i/ ヽ !
　　　　 ! ハ!|　　ー─　\'　　i　　!　 　 `\' 　 \'\' " 　 ||ヽ　l |
　　　　| | /ヽ!　　　　　　　　|　　　　　　　　　　　 |ヽ i　!
　　　　ヽ { 　|　　 　 　 　 　 !　　　　　　　　　　　|ﾉ　 /
　　　　　ヽ　 |　　　　　　　 _ 　 ,､　 　 　 　 　 　 !　, ′
　　　　　　＼ !　　 　 　 　 \'-ﾞ　‐ ﾞ　　　　　　　　レ\'
　　　　　　　 ｀!　　　　　　　　　　　　　 　 　 　 /
　　　　　　　　ヽ　　　　　ﾞ　￣　 ￣ ｀　　　　 / |
　 　 　 　 　 　 |＼　　　 　 ー ─‐ 　 　 　 , ′ !
　　　　 　 　 　 |　 ＼　　　　　　 　 　 　 ／　　 |
　　　　　　_ -‐┤ ﾞ､　＼ 　 　 　 　 　 ／　 ! l　 |`ｰr─-　 _
　_　-‐ \'"　　 / |　 ﾞ､　　 ヽ　＿___　 \'´　　 \'│　 !　 |　　　　　ﾞ\'\'‐-　､,_', '　　　　　　　,,.、　_､、
　　　　　　/　　};;ﾞ　 l　）） ｎｎｇｍｆｆ…
.　　　 　 ,i\'　　/　　/
　　　　 ;;ﾞ　 ノ　 ／　
　　　 ,r\'　　　　 `ヽ、　　　　三
　　 ,i"　　　　　　　 ﾞ;　 　　　　　　　三
　　 !.　ﾟ　　　　 ﾟ　 ,!\'\'"´´\';;⌒ヾ,　　　　(⌒;;
　(⌒;;　　　 ヮ　　　,::\'\'　　　　|⌒lﾞ　三　(⌒　　;;
　　`´"\'\'ｰ-(⌒;;"ﾞ＿＿､､､ノヽ,ﾉ　
　　　　　　　￣￣', '　　　　　 　,.、　　 ,r 、　　　　let\'s go back to 4chan. this place sucks.
　　　　　　,!　ヽ　,:\'　 ﾞ;
.　　　　　　!　　ﾞ, |　　 }
　 　　　　　ﾞ;　　i_i　 ,/　 　//￣ ｀ ～ ´⌒/
　 　　　　 ,r\'　　　　 `ヽ、.//　　樹　海　　/　　　　　　　　　　　　　　 　　 , -- 、_
　 　 　　,i"　　　　　　　 ﾞ//─～ , __ ,─´ 　　　　　　 　 　　, -- 、_　　 i・,、・　/
　 　 　　! ・　　　　・　　.//　　　　　　　　　　　　, -- 、._　　i・,、・　/　 　ゝ____ノ
　　　　　ゝ_　ｘ　　　　_// 　　　 　, -- 、._　　　i・,、・　/　　ゝ____ノ　　　::::\'::::\'::::
　　　　 /~,（`\'\'\'\'\'\'\'\'\'\'イ(⌒ヽ,　　　　i・,、・　/　　　ゝ____ノ　　　::::\'::::\'::::
　　　/⌒))/　　　　 (____ﾉ_)　　 　ゝ____ノ　　　　::::\'::::\'::::
　　　｀-´/　　　　　 　　i　　　　　::::\'::::\'::::
　　　　　｀ヽ________ ｲ iノ:::::::::::
　　 　:::::::::::,/＿、ｲヽ_ノ::::::::
　　　　:::::::(｀⌒´ノ::::::::::::', '　　 >┴<　　　⊂⊃
　-（ ﾟ∀ﾟ.）-　　　　　 　 　 　　⊂⊃
　　 >┬<
　　　　　　　　　　　　／⌒ヽ
　　　　　　　　　　　/（●）（●） 　　excuse me may i pass through here
　　　　　　　　　　　|　ﾄｪｪｪｲ/
　　　　　　　　　　　| /｀ﾆﾆ´
　　　　　　　　　　 //　| |
　　　　　　　　　　Ｕ　 .Ｕ
;;⌒::.;;.⌒⌒/ 　 /|￣￣￣￣￣/ ￣/::. :; ;⌒⌒:.:⌒:;⌒;;⌒
..　　,::.;　　/ 　 /|￣￣￣￣￣/ 　 /..,　,;　.:　　　,,｡,.（◯）　　 ::
　 :　:::.,　/ 　 /|￣￣￣￣￣/ 　 /,,;　　（◯）　　:::　ヽ|〃　　;;:
.　　,:.;　/ 　 /|￣￣￣￣￣/ 　 /..,　,;　:ヽ|〃　　,,｡,　　　 ::;;,', '　　　　　　∧∧　　Naah　　　　　　 ∧__∧　　　Hey. You heard something?
　　　　　 (　　 ,)　　　　　　　　　　 （∀｀　 ）
　 　 　 ||| /　　|　　　日　　　　 日　と　　　）|||
　 　 　 |||（,,＿/　　|￣￣￣￣￣￣|.へ　＿）|||
　 　 　 ｌ三三三l　 .￣||￣￣￣||￣(__l三三三l
　　　　　 ||　　|| 　 　 . || .　 　 . ||　　　 ||　　||
　　　"""""""""""""""""""""""""""""""""', '　　　　　　　　　　　　　　　　 ∴
　　　　　　　　 　 　 　 　　∴∵∴　　　　∴
　　　　　∴∵∴　 　 　 　 　 ∴∵∴　 ∴∴
　　　　　　　∵∴∵　 　 　 　 　 ∵∴　 ∴::: i^i_i^i_,‐､
　　　　 　 　 　 　 　 ∵:: .　　　　　　∵:.　　::/U::∪:｀U ..::∵∴
　 　 　 ∵∴∵ 　 　 　 　 : .　..　　　　:∵..::(つ/ ⌒ヽ).）　 ∴∵
　 　 ∴∵∴∵∴: : . 　　 . :　　 　 　 　 : .　| : | | 　　|　 　　　　∴∵
. : ∵∴∵　 　 　....... :　　.::＿＿＿　　　. :　|　:∪ / ﾉ　 　 ∴
.. : :∵　 　 　 ....::　　:: . :::::::∴∵∴＼. :.:　　| ∵| ｜|　 　 ∵　 ∵
.∴∵　 　 　::..::　　 .:::::::∵∴∵∴∵:＼:　　|∵∪∪　 . : 　 　 ∴∵
.∵　 　 　 ∵::　　　:::∵：(･)∴∴.(･)∵. l　 / . ∵ :: . : 　 　 　 ∵
∵　 　 ∴∵::.　　　::∵∴／ ○＼∵∴ | /　　　:: 　 　 　 　.∵
..　 　 ∵∴::　　 　 .::::∵/三　|　三ヽ∵ |/....:∴::　　　　　.∵　 ∵∴∵ 　「Don\'t think. Feel
.　　 ∵:..:.:/⌒ヽ::l⌒`i::..|　＿_|＿_　│∵|...:∵::　　　　.. :　 　 ∴∵ 　 and you\'ll be tanasinn」
. 　 :/⌒ヽ|　　|;; ;|　　|､.|　　===　　│／∴::　　　　. :　 　 .∵∴　 ∴
.　 :（　 ヽ;;ヽ__ﾉ;;; ヽ__ﾉ !＼＿＿＿／∵　::　. ... . :　 　 　 .∵　 　 ∴
..∴　>‐ ／￣.. ＼;;;;ゝ__`ト､.(●)━..:∴::　　　　　　　 . : 　 　 . ∴∵∴
∴. （ : :/　　　　,. i〃　　　 l　　. . . . . . . . . . .... .. . :　　　 ..:∵∴:
∴∵￣|　　　 /.| |､l＿＿_ノ　　　　_!＿!　　　　　　　　 .∴:
　 ∵　 |　　　| ：| |.　|　　　 　 　 ./∵∴ﾞi　　　　 　 . :　　　　　.:∴∵∴
　 　 　 |　|　 |　 | |. /.∴∵;;;;/‐‐| .∵∴ :: .. .... . :　　　 　 .∴∵∴∵
　　　　.| ｜　|　 Ｕ.::､∴∵;;/;）　 ﾞi∵∴∵:: ... .. ... .. . : :∵∴∵
　 　 　 | ｜　|　 　 :: .￣￣￣　　 ﾞi∵∴∵::.. ...::∴∵∴∵
　 　　 / /　/ 　 　 　: . . .　　　 　 （￣￣.... ::∵
　　　 / /　/ 　　　　　: :∴∵ : . 　 ￣.:∴:.　
　　　.しし’　　　　　　　　:: :: ∵: : .', '　 ∧＿∧　+　∧＿∧　　　　∧＿∧
　（　ﾟ ヮﾟ）　 　（　ﾟ ヮﾟ）　　☆　（　ﾟ ヮﾟ）　WE CAN DANCE
⊂　⊂　 ）　　（　Ｕ　　つ　　⊂__へ　つ 　WE CAN DANCE
　<　<　<　　*　）　）　）　　　　　（＿）|　　　　　　　EVERYBODY LOSE CONTROL
　（＿（＿）　　（_＿）＿）　　　 彡（_＿）', '　　 巛彡彡ミミミミミ彡彡
　　巛巛巛巛巛巛巛彡彡
　　|:::::::　　　　　　 　 　　i　　
　　|::::::::　　　 ⌒　　　⌒ |　　
　　|:::::　　　 -･=- ,　(-･=- 　　　　
　　| (6　　　　⌒ ) ･ ･)(　^ヽ　My furry friend! You are
　　|　|.　　　　　┏━━┓　|　 so attractive that I must yiff you.
　 ∧ |　 　　　 ┃ヽ三ﾉ ┃ |　　　　
／＼＼ヽ　　　　 ┗━┛　ﾉ 　　　　
／　 ＼ ＼ヽ.　 ─── /|＼　　 　　ノ７_,,, ､
　 　　(⌒､"⌒ソ⌒ヽ- ｲﾉ　 ｀､　 ( ｨ⌒ -\'"",う
　　　　~\'\'()()()()ソ-ｨ　　　　 ヽノ　　　,イ^
　 ＿ヽ　/｀､＿, ｨ/　　 ヽ　 　　　 ヽ─/
／,ｨ\'"／ 　　　　/　　　　｀､ 　　　　) /
　　　　　　　　　/ 　 i', '＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿_
|: : :＼: : : : : : : : : : :＼ : : : : : : ＼　＼: : :| 　 ＼|＼: : : : : : : : : : : |
|＼: : :＼: : : : : : : : : : |＼: : : : : : :|　　 ＼| ／＼　　＼: : : : : : : : :.|
|　 ＼: : :＼: : : : : : : : |　 ＼: : : : :|／.／／:::::::::: ＼ 　 ＼ : : : : : : |
|＼　 ＼: : :＼: : : : : : |　 　 ＼: : :|／／::::::::::::::::::::::::＼ 　 ＼: : : : :|
|: : ＼　 ＼: : : : : : : : :|　　 .／ ＼| \'::::::::::::::::::::::::::::::::::::::ヽ　　ｌ : : : :|
|＼ : :＼　 ＼: : : : : : :|　／ ／／:::::::::::::::::::::::::::::::::::::::::::::::| 　 | : : : |
|　 ＼ : :＼　 ＼: : : : :|　　く／＼／＼ :::::::::::::::::::::::::::::::::::|　　l : : : |
|＼　 ＼ : :＼　 ＼: : :|　 　 　 　 　 ／ ::::::::::::::::::::::::::::::／.　　|: : : :|
|: : ＼　 ＼: : :＼　 ＼|　　　　　　　 ＼:::::::::::::::::::::::::／　 ｜　|: : : :|
|＼ : :＼　 ￣￣　 　 　 　 　 　 　 　 　 ￣￣￣￣　　| 　 　 |: : : :|
|　 ￣￣　　　　　　　　　　　　　 　 　 　 　 　 　 　 |　　　　　|: : : :|
|　 .／ ／＼　　　　　　　　　 　 　 　 　 　 　 　 | 　 　 　 　 / : : : |
|／ ／／:::::::＼　　　　　　　　　　　　　　　　　　　　　　 　 / : : ／|
|.／／:::::::::::::::::::＼　　　　　　　　　　　　　　　　　　　　　 /: :／　 .|
|／:::::::::::::::::::::::::::::::ヽ　　　　　　 　 　 　 　 　 　 　 　 　 /／　　　 |
|＼／＼::::::::::::::::::::::::|　　　　　　　　　　　　　　　　　　　　　　　 　 |
|　 　 ／::::::::::::::::::::::::|　　　　 　 |　　　　　　　　 　 　 　 　 　 　 　 |
|　　　＼::::::::::::::::::::::/ 　 　 　 　 ＼＿／　　　　　　　　　　　 　 　 |
|　 　 　 ￣￣￣￣　 |　　　　　　　　/　　　　　　　　　　　　　　　 |
|＼　　　　　　　　|　　　　 　 　 　 　 ヽ _＿,　　　　　　　　　 　 ／|
| : :＼　　　　 |　　　　　　　　　　　　 　 　 　 　 　 　 　 　 　 ／　 |
| : : : :＼　　　　　　　　　　　　　　　　　　　　　　　　 　 　 ／　　　|
￣￣￣￣￣￣￣￣￣￣￣￣￣￣￣￣￣￣￣￣￣￣￣￣￣', '⌒Y⌒Y⌒Y⌒Y⌒Y⌒Y⌒Y⌒Y⌒Y⌒Y⌒Y⌒Y⌒Y⌒Y⌒Y⌒Y⌒Y⌒Y⌒☆　　*
　.人　　　人　　　人　　　.人　　　人　　　人　　　.人　　　人　　　人　　　 ﾉ　　　　☆
／　.＼／　 ＼.／　 ＼.／　 ＼／　 ＼.／　 ＼.／　 ＼／　 ＼.／　 ＼.／　☆　*
　 　 ┏┓　 　 ┏━━┓ﾊｧﾊｧﾊｧﾊｧﾊｧﾊｧﾊｧﾊｧﾊｧﾊｧﾊｧﾊｧﾊｧﾊｧ　.　┏━┓
┏━┛┗━┓┃┏┓┃(´д｀)(´д｀)(´д｀)(´д｀)(*´д｀)　　 ┃ 　┃
┗━┓┏━┛┃┗┛┃┏━━━━━━━━━━━━━━┓ 　 ┃ 　┃
┏━┛┗━┓┃┏┓┃┃　　　　　　　　　　　　　　　　 　 　 　┃ 　 ┃ 　┃
┗━┓┏━┛┗┛┃┃┗━━━━━━━━━━━━━━┛ 　 ┗━┛
　 　 ┃┃ 　 　　 　 ┃┃(´д｀*)(´д｀*)(´д｀*)(´д｀*)(´д｀*) 　　┏━┓
　 　 ┗┛ 　 　　 　 ┗┛ﾊｧﾊｧﾊｧﾊｧﾊｧﾊｧﾊｧﾊｧﾊｧﾊｧﾊｧﾊｧﾊｧﾊｧ　　.┗━┛
⌒Y⌒Y⌒Y⌒Y⌒Y⌒Y⌒Y⌒Y⌒Y⌒Y⌒Y⌒Y⌒Y⌒Y⌒Y⌒Y⌒Y⌒Y⌒☆　　*
　.人　　　人　　　人　　　.人　　　人　　　人　　　.人　　　人　　　人　　　 ﾉ　　　　☆
／　.＼／　 ＼.／　 ＼.／　 ＼／　 ＼.／　 ＼.／　 ＼／　 ＼.／　 ＼.／　☆　*', '★ VIP women and conquer method ★

    * First, visitors from more please.
    * All registration, write once

After the wish of the VIP We look forward to taking the immediate future to decide please.

Note high-income women members has been registered so many support you,
Personal guarantee. , But 74 percent of establishing出会えます.

    * Contact person can not wait for the attack to search women like members please.

Note the color and women who may be circumstances, such as personal information questions please stop.

Useful information ☆ ☆ ☆ ☆ ☆ Useful information Useful information Useful information ☆ ☆ ☆

♪ ♪ latest to introduce more women registered to please your admission. → KOCHIRA

Useful information ☆ ☆ ☆ ☆ ☆ Useful information Useful information Useful information ☆ ☆ ☆

Attack started earlier than anyone! !

All available completely free!

★ ★ VIP recruit women members', '
　　　　　♪　　☆
　　　♪　　　／ ＼　　　 RANTA TAN
　　　　　　ヽ(´Д｀;)ﾉ 　　RANTA TAN
　　 　 　　　 (　 へ) 　　　RANTA RANTA
　 　 　 　 　　く 　　　　　　TAN

　　　♪　　　　☆
　　　　　♪　／ ＼　　　RANTA RANTA
　　　　　　ヽ（;´Д｀）ﾉ　　RANTA TAN
　　 　 　　　 (へ　 ) 　　　RANTA TANTA
　 　 　 　 　　　　 >　　　　TAN', '　　　　　　　 　　 　　/ ） ／￣￣￣￣￣￣￣
　　　　　　　 　　　 ./ /　| Our theme
　　　　　　　　　　 / /　　＼　　　　　　　　　 ／￣￣￣
　　　　　　 　　　 / /　　　　￣|／￣￣￣￣|　is death！
　　　　　　　　　./ /＿Λ　　　　　, -つ　　　＼
　　　　　　　 　/ /　 ﾟДﾟ）　 .／_ノ　　　　　　　￣∨￣￣￣￣
　　　　　　　　/　　　　＼　／ /　　 ⊂_ヽ､
　　　　　　　 .|　　　　へ／ ／　　　　　　.＼＼　Λ＿Λ
　　　　　　　 |　　　　ﾚ\'　 /､二つ　　　　 　 ＼ （　　ﾟДﾟ）
　　　　　　　 |　　　　　／.　　　　　　　　　　.　>　　⌒ヽ
　　　　　　　/　　　／　　　　　　 　　　　　　/　　　 へ ＼
　　　　　　 /　 ／　　　　　　 　 　　　　　　/　 　 /　　 ＼＼
　　　　　　/　 /　　　　　　　　　 　　　　　ﾚ　　ノ　　　　　ヽ_つ
　　　　 ／　ノ　　　　　　　　　　　　　　　/　 /
　　　_/　／　　　　　　　　　　　 　　　　/　 /|
　 ノ　／　　　　　　　　　　　　　　　　　（　（　､
⊂ -\'　　　　　　　　　　　　　　　 　　　　|　 |､　＼
　　　　　　　　　　　　　　 　　　　　　.　　|　/　＼　⌒l
　　　　　　　　　　　　　　　　　　　　　　　|　|　　　）　/
　　　　　　　　　　　　　　　　　　　　　　ノ　 ）　　 し\'
　　　　　　　　　　　　　　　　　　　　　(＿／', '　　　　⊂_ヽ､
　　　　　　.＼＼　 ／⌒＼
　　 　　　　　 ＼ （　冫、） 　　　　　　I cast Dark Ritual
　　　　　　　　　 >　`　⌒ヽ
　　　　　　　　　/　　　 へ ＼
　　　　　　　　/　 　 /　　 ＼＼
　　　　　　　　ﾚ　　ノ　　　　　ヽ_つ
　　　　　　　 /　 / 　　　　　　　　･*.･:
　　　　　　　/　 /| 　　　　　　　　　:。　*.・
　　　　　　 （　（　､ 　　　　　　　　　.*:☠。:’☠
　　　　　　　|　 |､　＼ 　　　　　　　。・．*・;　・*
　　　　　　　|　/　＼　⌒l 　　　　　　;*　・。;*☠ ・.
　　　　　　　|　|　　　）　/ 　　　　　・☠ *_,,..,,,,_ ☠。*・
　　　　　　ノ　 ）　　 し\' 　　　　　　。・*./ ,\' ☠　 `ヽｰっ*
　　　　　(＿／　　　　　　　　　　。・*．;l　　 ☠　⌒_☠ ’☠
　　　　　　　　　　　　　　　　　　　　.　　`\'ｰ---‐\'\'\'\'\'"', '　　 　 　 　 　 　 　 　 | |
　　 　 　 　 　 　 　 　 | |　　　　　／￣￣￣￣￣￣￣￣￣￣￣￣
　　　 　 　 ∧＿∧ 　 | |　　　 ／　
　　　　 　 （ ；´Д｀）／/　　＜　PENIS
　　　　　 ／ 　 　 　 /　　　　 ＼
　　　　 / /|　　　　/　　　　　　　＼＿＿＿＿＿＿＿＿＿＿＿＿＿
　 ＿＿| | .|　　　　|
　 ＼　 ￣￣￣￣￣￣￣＼
　　||＼　　　　　　　　　　 　 ＼
　　||＼||￣￣￣￣￣￣￣||￣
　　||　 ||￣￣￣￣￣￣￣||
　　 　 .||　 　 　 　 　 　 　 ||', '　　　　＿_
　　\'´　　　ヽ
●ｌｶﾉﾉﾙ ﾋﾟﾉ●
　 从 ﾟ ヮﾟ ﾉｿ 　Pyo! Penis, pyo!
　⊂［］二［］つ　　　　　　　　
　　 /　B　ヽ
　　<　　　　 >
　　　（/ ∪', '　　 　 ∧＿∧∩　／￣￣￣￣￣￣￣￣￣￣￣￣￣￣￣￣
　　　 （　´∀｀）/＜　How do we know that I\'m not a 4channer?
　＿ / /　　 /　　　＼ 　　
＼⊂ノ￣￣￣￣＼ 　＼＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿
　||＼　　　　　　　　＼
　||＼||￣￣￣￣￣||
　||　 ||￣￣￣￣￣||
　 　 .|| 　 　 　 　 　||', '　　　-‐‐- 、
／　　　　　ヽ
!　 !　人|,.iﾉl_ﾉ）　　　　If you\'re not ordering something you\'ll have to leave.
i 　乂-‐　－! i
＼ヽ .ゞ　- ﾉノ
　　｀｀フ　i´
　 　 / ＼ﾉゝ
　　/__i |丱!|
━━つ━つ━━∞∞∞===========', '凸凸凸凸凸凸凸凸凸凸凸凸凸凸凸凸凸
凸凸凸凸凸凸凸凸凸凸凸凸凸凸凸凸凸
凸凸凸凸凸凸凸凸凸凸凸凸凸凸凸凸凸

the alternative to crap at the top of the
board is to post even more crap and bump
the crap to the top of the board so the crap
gets shifted around while you make a self-
congratulatory post about how it\'s some
sort of duty you\'re fulfilling by posting
crap to counter others posting crap.

凸凸凸凸凸凸凸凸凸凸凸凸凸凸凸凸凸
凸凸凸凸凸凸凸凸凸凸凸凸凸凸凸凸凸
凸凸凸凸凸凸凸凸凸凸凸凸凸凸凸凸凸

This is of great importance.

凸凸凸凸凸凸凸凸凸凸凸凸凸凸凸凸凸
凸凸凸凸凸凸凸凸凸凸凸凸凸凸凸凸凸
凸凸凸凸凸凸凸凸凸凸凸凸凸凸凸凸凸', '　　　　　　　　　　..｡＊+　*　　　　　　　　　　　　　。　*。
　　　　　　..ﾟ..*+。*★*　。＊　　　　　　　　。　*★*｡+*＊∵
　　　　。.ﾟ+ﾟ☆ﾟ*　　∵☆*．＊　　　　．.*.☆∵　 　..∵☆ﾟ+.ﾟ・
　　　。★。ﾟ　　　　 ,-､..。★.ﾟ　＊　　ﾟ.★。　,.-､　　　．ﾟ..★＊
　　ﾟ*☆＊　　　　 ./:::::＼∵☆*..∵*☆∵／::::::ヽ　　　　*..ﾟ☆ﾟ
　＋★。　　　　　/::::::::::::;ゝ--──-- ､._/::::::::::::::|　　　　 ..。★＊　　　
ﾟ*☆＊　　　　　 /,.-‐\'\'"´ 　　　　　　　　 ＼:::::::::::| 　　　　　..☆ﾟ∵　　　　　　
。★*.ﾟ.ﾟ　　　／　 　　　　　　　　　　　　　　ヽ､::::|　　　　 ....*★＊
. 。☆＊　　/　　　 　　　　　　　　　　　　　　　　ヽ　　　　。..ﾟ☆ﾟ*
　。★。　　 l　　　　／　　　　　　 　 　 　 　 　　　l　　 ..。★＊
　ﾟ*ﾟ☆＊ . |　　　 ⌒　　　　　　　　　　　＼　　　 |　　 ....☆ﾟ∵
　　　。★ 　l　　, , ,　　　　　　　　　　　⌒　　　　 l　　∵★＊
　　　ﾟ*..☆*` ､　　　　　　(_人__丿　　　　､､､ 　 / 　　ﾟ☆ﾟ∵
　　　　。★。　`ｰ ､__　　　　　　　 　　 　　　 ／ 。★＊
　　　　 ∵*ﾟ☆＊ 　 /`\'\'\'ｰ‐‐──‐‐‐┬\'\'\'""´..☆ﾟ∵
　　　　　　。★∵./　　　　　　　 　 ___l　。★＊。
　　　　　　　　ﾟ＊☆ﾟ　 ./　　　　／　 |.-､☆ﾟ∵
　　　　　　　　　_,,..,,,,_ｰ-<　　　　/　　。|★＊。
　　　　　　　　/ ,\' 3　 `ヽｰっ--{__。..*ﾟ..､,ノ
　　　　　　 　 l　* ⊃　⌒_つ。*★*ﾟﾟ
　　　　　　　　`\'ｰ---‐\'\'\'\'"', '　　　　　　　| 　　.＿
　　　　　　　| 　［］＿］
　　　　　　　| 　　|| |∧ ∧
　　　　　　　| 　 （　(*ﾟーﾟ)＜ I sure do enjoy pooping
　　　　　　　| 　　ヽ（ つ⊂）
　　　　　　　| 　　|| (ヽ　） ） (￣◎
　　　　　　　| 　　 　）し\'し\'　 |~~~|
　　　　　　　| 　　　⊆=⊇　　￣゛
　　　　　　　￣￣￣|; : |￣￣￣￣
　 　　　　　　　 　　 |●|
　 　　　　　　　 　　 |; : |
　 　　　　　　　 　　 |●|
　　　　　　　　 　 　 |; : |
　　　　　　　　 　 　 |●|
.　　　　　　　　|￣￣; :　￣￣|
.　　　　　　　　|　 ∧●∧ I like to end my sentences with the word pyo!
.　　　　　　　　|　（ ﾟ ヮﾟ　 )　..|
.　　　　　　　　|:::（　 　　 ） ::::|', '　　　*\'``・* 。
　　|　　　　 `*。
　,｡∩　　　　 　*
+　(´･ω･`)　*｡+ﾟ I don\'t have any genitals!
　`*｡ ヽ、　 つ *ﾟ*
　　`・+｡*・\' ﾟ⊃ +ﾟ
　☆　　 ∪~ ｡*ﾟ
　　`・+｡*・ ﾟ', '( ・ω・) ahem

( ・ω・) ♫You got a butt.♫
( ・ω・) toot
( ・ω・) ♫You got a butt in yo butt.♫
( ・ω・) toot
( ・ω・) ♫You got a butt in yo butt in you butt.♫
( ・ω・) toot', '| ◎∧
|´･ω･) I did not kill my wife!
|.　V　ﾊ
|___:|__|)
|__)＿)', '*put* 　∧＿∧ /
　　　　　( ・ω・)　< This thread is going places!!
*put* 　 （　⊃┳⊃ ヽ
　 ＼ ___ｃ(＿) ￣＼＿__ *put*
　　 | 　　 .|￣￣| ]◘
≡≡ ▬◎―――――-◎', '　　　　　　　 ＿＿／＼＿＿
　　　　　　　＼　LUCKY　／
　　　　　　　　　CHANNEL　　　Why, thank you! ☆
　　　　　　　　　|／　　＼|
　　　ｧ\'ﾞ´´´^ゝ　　 　 　 (⌒ヽ　ﾉl_　　｡☆
　 　 ミr\'(~｀ｿﾘ　　☆。　 〃´￣　く ’　　　
　　　`(l ´ｰ｀ﾉ　　 　 　　ﾉ/j/{"}Vﾘﾄ　+ *
　 　 ./T｀ｉ：h　 　 　☆ /＾ﾙ(!^ヮﾟﾉヘ、
　　　| .|　|：|.|　　　　　｛：ノゝ}i兆〈ﾍ.：｝
￣￣￣￣￣￣￣￣￣￣￣￣￣￣￣￣￣', '　　　　　　　　　　　　　 ∧∧
　　　　　　　　　　　　　( ﾟДﾟ)　～ I FARTED!
　　　　　　　　　　　　⊂　　つ
　　　　　　　　　　　　　(つ ﾉ
　　　　　　　　　　　　　 (ノ
　　　　　＼　　　　　　☆
　　　　　　　　　　　　　|　　　　　☆
　　　　　　　　　　(⌒ ⌒ヽ　　　/
　　　　＼　　（`⌒　　⌒　　⌒ヾ　　　／
　　　　　 （\'⌒　;　⌒　　　::⌒　　）
　　　　　（`　　　　　）　　　　　:::　）　／
　　☆─　（⌒;:　　　　::⌒）　:;　　）
　　　　　（⌒::　　　::　　　　　::⌒　）
　　 　／　（　　　　ゝ　　ヾ　丶　　ソ　─', '　　　　　　　　　　　　　　　　　 ／　　　 　 　 　 　 　 　 ＼
　　　　　　　　　　　 　 　 　 ／　　　　　　　　　　　　　　　 ヽ
　　　　　　　　　　　　　 　 /　　　　　　 　 /　　　　　　　 　 　 ,
　　　　　　　 　 　 　 　 ,.ィ　 　 ,\' ,　　 　 /｜|　i　　 　 　 　 　 i＼
　　　　　　　　　　　　 〈:::{　! 　 ! i.　　,ｲ/　 l |i　i　　 　 　 　 　 l:::::＼　　
　　　　　　　 　 　 　 　 V! :i　　ｉ ﾄ､　ﾅiト､　V ヽﾄ､. ｋ　}:.　 : 　 |::::::::/
　　　　　 　 　 　 　 　 　 | ハ.　Ｎ |厶、　　 　 　 ヽ!ヽﾄ1 .: 　 l::::::/　　　　
　　　　　　　　　　　 　 　 }i　 l　| ,ィ\'::;::ヾ　　　 　 ｨ\':::;::ヾﾊ! :: 　 |:::/
　　　　　　　　　　　　　 /:::|　 lN《 とし:::}　　　　　{うJ:::} 》 ::　　l;/
　　　　　　　　　　 _r～ｰ┐l　 iﾊ.` ｰ \'\'"　　 ,　 　 ｰ\'==\' \' | ;　　ﾄ､　　　　
　 　 　 　 　 　 ／　 ＞=く:::|　 i| !:.::::.　 　 r==､　　.:.:::.:. /|/ 　 |::::〉
　　　 　 　 　 /　 ／　　／}:ヽ　｢`:､.　　　｛　　｝　　 　 ﾉr1　 ,厶-､ _
.　　　　 　 　 ヽ　　 　 \'　 /｀i ﾄ｜　ｉト .　　 ー\'　　 , イ:/:/ 匕-:r‐く　＼
　　　　　　　　　＼＿　　　 ｲ ヽＮヽﾄトN＞ - ‐ \' /ﾉiﾉ:i: /⌒ヽ　＼ ＼
　　　　　　　　　　　 ｝　　　 |　　　_,／｢{　　　 　 ﾊ､jイ ,i┘ 　 ヽ
　　　　　　　　 　 　 |　　 　 トr;┬|: : : | |　　　 //: ::＼.{
　　　　　 　 　 　 　 |　　　 卜{　|:::|: : : | l　　 //: : : :://　　　 :-r一\'\'´
　　 　 　 　 　 　 　 |　　 　卜,{　|:::|:: : : l |　//: : : : /\'/　 　 　 /￣｝
　 　 　 　 　 　 　 /|　　 　 .Kﾍ!｜::|: : : :ｌ.l//: : : : /;\'/　 　 　 /￣ ＼
　　　　　　　　　 /::|　　　　.|::ト{　|::::|: : : //: : : : /:,\'/　 　 　 /＼ 　 ﾉ
.　　　　 　 　 　 |: :|　　　　 |:::ト{　|::::|: :://: : : : /,〃　 　 　 /　　 Y
　　　　　　　 　 |: :|　　　　｜::ト{　ー`‐\'\'―‐一勿ﾘ　 　 　 ,ﾊ 　 ,丿

Hey, it\'s Clara. Last night was amazing. I\'ve never known a guy who
could keep going as long as you did, you were like a machine! I can\'t
believe we stayed up until 4 in the morning playing Super Smash Bros.
together. If you\'d like, I don\'t have any plans this next weekend...
hee hee. Maybe next time...I\'ll let you be Kirby.', 'Nice Boat. wwwww

oat.　　　　　　　　　　Nice Boat.wwwww wwww w Boat
　　nice boat
wwwwwwwwwwwwww Nice Boat

                             Nice boat!      Nice Boat.

　　　　　　　　　　wwww
ice Boat. wwwwww

                Nice Boat                Nice

　 　 　 　 　 　 _ Nice boat
　　　　　　　　ﾉ |_ 　 ll__l---||＿　　　　　　　Nice　boat !!!
　　　　　　rj「ｌ＿_｀ｰ\'　 ヽｌーｊ　 L---┐
　　　　　 |―┴┴―｀ｰｒｭ-‐<￣.ｨｊ .__ｊｌ
　Nice Boat[][][][] i　""" _..,,ｒr=\'\'´　l
　　　　　 l￣￣￣￣/7-‐\'´　　　 　／
　　　f　 ｊL-､ ＿-‐\'　　　　　 -‐´~~
　　　ヽ |　￣　　＿ｊ＿ -‐\'~´~~NICE BOAT
　　　　 ｀ー～´~~~~', '　　　　　　　 　 ∧_∧
　　　 　　　 ⊂（･ω･ ）つ-、　
　　　　　 ／／/　　 /_/:::::/ 　Oh darn...
　　　　　 |:::|/⊂ヽノ|:::| ／」　　
　　　 ／￣￣旦￣￣￣／|
　　／＿＿＿＿＿＿／ | |
　　| |-----------|', '　　へ-ﾍ
　 ﾐ*´ｰ｀ﾐ I am security kidden, nya.
～(,_ｕｕﾉ', ',,....,,;　 ＿人人人人人人人人人人人人人人人人人人人人人人人人＿
-\'\'":::::::::::::｀\'\'＞　　　　　　　　　　　TAKE IT EASY ！！　　＜
ヽ:::::::::::::::::::::￣^Ｙ^Ｙ^Ｙ^Ｙ^Ｙ^Ｙ^Ｙ^Ｙ^Ｙ^Ｙ^Ｙ^Ｙ^Ｙ^Ｙ^Ｙ^Ｙ^Ｙ^Ｙ^Ｙ^Ｙ^Ｙ^￣
　|::::::;ノ´￣＼:::::::::::＼_,. -‐ｧ　　　　　＿_　　 _____　　 ＿_____
　|::::ﾉ　　　ヽ､ヽr-r\'"´　　（.__　　　　,´　,, \'-´￣￣｀-ゝ 、 イ、
,.!イ　　_,.ﾍｰｧ\'二ﾊ二ヽ､へ,_7　　　\'r ´　　　　　　　　　　ヽ、ﾝ、
::::::rｰ\'\'7ｺ-‐\'"´　 　 ;　 \',　｀ヽ/｀7　,\'＝=─-　　　 　 -─=＝\',　i
r-\'ｧ\'"´/　 /!　ﾊ 　ハ　 !　　iヾ_ﾉ　i　ｲ　iゝ、ｲ人レ／_ルヽｲ i　|
!イ´ ,\' |　/,.!/　V　､!ﾊ　 ,\'　,ゝ　ﾚﾘｲi (ﾋ] 　　 　ﾋﾝ ).| .|、i .||
`! 　!/ﾚi\'　(ﾋ] 　　 　ﾋﾝ ﾚ\'i　ﾉ　　　!Y!""　 ,＿__, 　 "" 「 !ﾉ i　|
,\'　 ﾉ 　 !\'"　 　 ,＿__,　 "\' i .ﾚ\'　　　　L.\',.　 　ヽ _ﾝ　　　　L」 ﾉ| .|
　（　　,ﾊ　　　　ヽ _ﾝ　 　人! 　　　　 | ||ヽ、　　　　　　 ,ｲ| ||ｲ| /
,.ﾍ,）､　　）＞,､ _____,　,.イ　 ハ　　　　レ ル｀ ー--─ ´ルﾚ　ﾚ', '　　　　 　 ,. -ｰ- 、
　　　　 　{∧＿∧}
　　 　 　 (´･ω･`)　I\'m not wearing pants.
　　　　　（二二二）
　 　 　 　 ＼ 　／
　　　　 　 ｉ´　　`i
￣￣￣￣￣￣￣￣￣￣￣
.　　　　　 ＿＿＿　　-pkunk-
　　　　　（二二二）
　 　 　 　 ＼ 　／
　　　　 　 ｉ´　　`i
￣￣￣￣￣￣￣￣￣￣￣', '
　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　(巛ミ彡ミ彡ミ彡ミ彡ミ彡）ミ彡ミ彡）ミ彡)
　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　,,从.ノ巛ミ　　　 彡ミ彡）ミ彡ミ彡ミ彡）ミ彡)\'\'"
　　　　　　　　　　　　　　　　　　　　　　　　　　　　 人ノﾞ　⌒ヽ　　　　　　　　　彡ミ彡）ミ彡）ミ彡)\'
　　　　　　　　　　　　　　　　　　　　　　,,..､;;:～\'\'"ﾞﾞ　　　　　　 ）　　从　　　　ミ彡ミ彡）ミ彡,,）
　　　　　 （ ⌒-⌒） 　　,,..､;;:～-:\'\'"ﾞ⌒ﾞ　　　　　　　　　　彡　,,　　　　 ⌒ヽ　　　　 ミ彡"　
　　　　　と　 　　 つ::::::ﾞ:ﾞ　　　　　　　　　　　　　　　　　　　　\'"ﾞ　　　　　　　　Д・ミ彡）\'\'"　
　　　　　　|:::. |::.　|　　 \'｀`ﾞ⌒｀ﾞ"\'\'～-､:;;,_　　　　　　　　　　　　　　）　　 彡,,ノ彡つ～\'\'"　　　
　 　　　　（＿_）＿）　　　　　　　　　　ﾞ⌒｀ﾞ"\'\'～-､,,　　　　 ,,彡⌒\'\'～.\'\'"/　/　 /　　　　　　　
　　　　　　　　　　　　　　　　　　　　　　　　　　　　"⌒\'\'～"　　　　　　（＿（＿_）　　　　　', '_∧∧☆_∧∧＿∧　　　　／／
∀｀) ・∀・（　´∀｀） .／|　 ＵＳＡ！ＵＳＡ！ＵＳＡ！
　　（　 ￥（　 　 つЯ＼|
　　||　 | ｜ ｜ ｜　　　 ＼＼　　　　 ＼＼　ＵＳＡ！ＵＳA！／／
￣￣￣￣￣￣￣￣￣ヽ
￣| |￣￣￣| |￣￣ ヽ　 |ΛΛ　ΛΛ　ΛΛ　Λ ΛΛ　ΛΛ　ΛΛ　Λ
　 | | 　 　 　| |　　　　 |　|∧＿∧∧＿∧＿∧　∧＿∧＿∧　　∧＿∧
￣　￣￣￣　 ￣￣￣　 |´∀｀　（´∀｀　）´∀｀（´∀｀　）´∀｀）（´∀｀　）
　　　∧＿∧∧＿∧ ∧＿∧∧＿∧∧＿∧∧＿∧∧＿∧∧＿∧
　　 （　　　　）　　　 （　　　　 ）　　　（　　　　）　　　 （　　　　）　　　　）
　　∧＿∧∧＿∧∧＿∧ ∧＿∧∧＿∧∧＿∧∧＿∧ 　∧＿∧
　 （　　　　）　　　 （　　　　）　　　 （　　　　）　　　 （　　　　）（　・∀・)＜ＵＳＢ
　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　 ┏━○
　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　○┻┳━|＞
　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　┗■', '　　　　 　 　 　 　 　 |　　　 丶　＿　　　　.,!　　　　　ヽ
　　　　 　 　 　 　 　 >　　　　 ｀`‐.｀ヽ、　 .|、　　　　　|
　　　　　　　　　　　　 ﾞ\'．　　　　　,ト ｀i､　 ｀i､　　　 .､″
　　　　　　　 　 　 　 　 |　　　 .,.:/""　 ﾞ‐,.　｀　　　 /
　　　　　　　　　　　　　`　 .,-\'\'ヽ"｀　　　　ヽ,,,、　　 !
　　　　　 　 　 　 　 　 ､,､‐\'ﾞl‐、　　　　　 .丿 : \':、
　　　　 　 　 　 　 　 ､/ヽヽ‐ヽ､;,,,,,,,,,-.ッ:\'\'｀　　.,"-、
　　　 　 　 　 　 　 ,r"ﾂぃ丶　 ｀｀｀｀｀｀　　　..／　 ｀i､
　　　　　　　　　　,.ｲ:､ヽ／ー｀-､-ヽヽヽ､－´　　　 .lﾞ｀-、
　　　　　　　　 _,,lﾞ-:ヽ,;､、　　　　　　　　　　　　 ､､丶　 ﾞi､,,、
　　　　　　　 ,<_ l_ヽ冫｀\'｀-､;,,,､､､､.............,,,,､.-｀": 　　　│ ｀i､
　　　　　 ､､::|､､､ヽ,､､.　　　　｀｀｀: : : ｀｀｀　　　　　　､.､\'｀　　.|丶、
　　　　　.l","ヽ､,"､,"\'､ぃ､､,､､、、.、、、.、、､､.,,．ヽ´　　　　lﾞ　 ﾞ)..
　　　 ,､\':ﾞl:､､｀:ヽ､｀:､　 : ｀"｀｀｀￢――\'\'\'"｀ﾞ＾｀　　　　　: ..､丶　 .lﾞ ｀ヽ
　　　,i´.､ヽ".､".､"\'ヽヽ;,:､........、　　 　 　 　 　 ､､...,,,､－‘｀　　 ､‐　　 |ﾞﾞ:‐,
　 ,.-l,i´.､".`ヽ,,,.".｀　　　｀ﾞﾞ\'"｀\'-ｰ"｀｀"｀｀r-ｰ｀\'":　　　　　 _.‐′　　丿　 ,!
　j".､\'ヽ,".､".､"`\'\'｀ｰ､.､、、　　　　　　　　　 　、.,、..-‐:\'\'\'′　　 .､,:"　　丿
　ﾞl,""\'\'ヽヽ"`"｀　 ｀｀｀ﾞ\'\'\'"ヽ∠、､、､ぃ-｀\'\'\'\'": ｀　　　　　　､..／｀　 ./｀
　 ｀\'ｉ｀ヽヽヽ｀\'\'ｰi､､、: : 　　　　　　　　　　　　　　　　　 、.,-‐\'｀　　 、／｀
　　 ｀ヽン\'"｀　 : ｀~｀｀―ヽ::,,,,,,,,,,.....................,,,,．ー\'｀｀＾　　　　,､‐\'"｀
　　　　　 `"\'ﾞ―-､,,,,..､、　　　　　　　　　　　　　　　 　: ..,､ー\'"\'｀
　　　　　　　　　　　: ｀‘"｀―---------‐ヽ｀｀"\'\'\'\'\'\'""', '　 ＿
　　 　 ／:::::::::｀丶
.　　　,\'::::::::::::::::::::::\',
　　　,!:.､_:‐:-:__,:.:.,l、
　 　 {i:.riｯ:i:i:.tiぅ:.:{f!　　　　GOGO！
　　　ﾞ\'､:.:.r{:lｭ､:.:.:,K-;- 、
　　　　ヾ:､―ｯ:\'/:.:.:/;　; ￣了二＞-､
　 ,.-rュ_ヽ二:ノ:.:.:/; ;　\',　　{:.:.:.:｀丶:.:.＞―-､__,.　\'⌒丶､
　{　 ｀`＜)`::y::／ ;\' ;　 \'、　\'､:.:.:.:.ノ:.:.:.:::::::::::::::/_,.イ::T:>､）
.　\',　　　「｀￣´　　;　\'、 丶　 ヽf´､:.:.:.:.:.:.:.:.:.:.:.Y_iうししし\'
　/| 　 　!:\' 　　　　;.　　　　　　 ヽﾆl￣￣｀` ー`´―一\'′
　\',j　 　 |:　　　　 ,\'、　　　　　　　　l
　 l、＿_,!　　 　　;　\',　　　　　　　　\',
　 ,!:::.:i:.:.\'、　　　,\'　　\'、　　　　　　　\',
　/:::.:.l!:.:.:iゝ、　　 　 　 　 　 　 　 　 \',
　!::::.:.l|:.:.:.:〉 ヽ　　　　　　　　　　　　 ,l、
　｀､:.:ﾉ､:./　 　\',　　　　　　　　　　 ,.ｨl}｝
　　ヽ､:ノ　　　　､＿＿＿＿_,,..ィfl{|jﾚ<\'ヽ
　　　　　　 　　 ﾊti｛{lIIｴ王l彡手\'´,ヽ l: :\',
　　　　　　　　/: :ヾ: {:.{￣: ,\': : /: :ﾉ: |｜: :\',
　 　 　 　 　 /: : : \',:ヽ､ﾄ､: : : :/: /: : t \'、: :\',
　　　　　　 /: : : :_:_:ノヾ{: : : （: /: : : : ヽヽ: :\',
　　　 　 　/-‐ \'´　 ;_　 \'i,: : : :ﾍ:ノ: : : : :.ヽヽ:!
　　 　 　ノ　 ,. - \'´:.:.\', 、:\',: /｀メ､: : : : : : ゝ-\'、
　　　 　 ｀７´:.:.:.:.:.:.:.:.:l ﾄ､从‐-,、丶--‐ \'　人l
　　　　　 /:.:.:.:.:.:.:.:.:.:.ﾉ⌒´ ヽ: {ヽ、　　_,. -{
　　　　　,\':.:.:.:.:.:.:.:.:／　　　　丶!　ﾄ-‐\':.:.:.:.:.|', '　　　　　 　 　 　 　 ▂▄▄▂
　　 　 　 　 　 ▄▆███■█▀〓▆◣
　　　 　　　◢████◤　◢◤　　　▄◣▂◥◣ 　　▃▂
　　　　　◢█████　▐　　▂　▐◣　◥◣ ◥◣◢█▀█
　　　 　 █████▋　 ◤ ▐◣　◥◣ ◥▐▀▋ ██◣▆▋
　　　　 ██████◣ 　 　◥◣ ▇▀▋ ▀▼◥███◤
　 　 　 ███████◣　　　◥■█▋ ▍ 　　　　 ▎
　　　 　 █████■▀▆◣　　　　　 　 　 　 　 ▍
　　　　　▀███▋　　▂　　　　　　　 　　　▄◤
　　　　　　▀███◣　　▼〓━▬▄▄▅▅◆
　 　 　　 　 ◥███◣　　 ▂▀◥◣▃▂◢◤▄◤
　　　　 　 　　██▆◣　 　 　 　 　 ▂▅█▅▃
　 　 　 　 ▂▅█■▀██▇▅▆▇██▀■██▇◣
　　 　 　▆██▀　　　███■■■▇◣ 　◥██▋
　　　　 ███◣▂ 　　▐▀▓▓▓▓▓▓▓◥▍▀■▌
　　　　　▀█◤ ▍ ◥◣▐▓▓▓▓▀▓▓▓▀▓▍　◥▎▂
　　　▂◢〓▍　▎◥◣　▐▓▓▓▎▐▓▓▍▐▓▍　┃ ▎
　　▐◣▄━▎ 　◥◣　◢▓▓▓▓▓▓▓▓▓▎▂◢▀
　　　◥▂　 ◥　　▂◢▓▓▓▓▓▓▓▓▓▓▓▊
　　　　　▀◥▪◣▀▐▓▇▅▓▓▓▓▓▓▓▓▓▍
　　　　　　　　　　◥██▲▓▀〓▓▓▓〓▀
　 ▂◢━◣▂ 　　　　◢███◤　 　 ▀▓▅▌
◢▀〓◣▂░::::◥◣ 　◢███◤　 　 　◢██◤
▍░:::: ▀◥◣░::::◥▅███◤　 　　 ◢██◤
▐::::░░::::◥◣◥◣　◥▎▀▉　　▃◤▆██◤▂▃▬▂
　◥▂░░:::: ◥▲::::░░▎ ◢::::░▀■░▍::::░░::::◥◣
　 　◥▃░░::◥◣▲░::::▍▍░░░░::::░░░░░:::::▍
　　　　 ▀◣▂◢◤▼◣░▎▐::::░░░░░░░::::▂◆
　 　 　 　 　▀▃░▂▼　 ◥◣▄◢◤〓▄◢〓◤▀', '　　　　　 　 ▂▬◢◤━━▪▬▂
　　　　　▄▀　 　　　　　　　　 ◥◣▂
　　　 ▄█▅◤　　　　　 　 　 　 　 　 ◥◣
　　　▇█■　　　　　　◥◣ 　 　 　 　 　▍
　　▄█▼▆█■◤ ◥◣　　　　　　　 　 　┃
　▅▀ ▋　 █▌　　　　　　　　 　 　 　 　 ◥◣
　 █▍　 ██▄　　　　　　 　 　 　 　 　 ▂▆
　 ██◣　█▊　▃ 　 　 　 　 ▂▀▄▂▄▅█■
　 ▐█▄　█▄▅▆▆▅▄ ▄▆█■▀■▌ █▼▎
　　▀█▆▇██▅■▀▊　 ▼▊▀▀◣▎▼ ◢▎
　　 ██▅█▌▀　　 ▲　　　　　　　 　▍ ┃
　　　████ 　　▆▀▋▂▃◢▀▅ 　 　 　 ┃
　　　　███▇▄▆▼▀■▀ 　 ▀█◣　 　┃
　　　 ■███▀█　▄ ▅▲▅◆▊　　 　┛
　　　　　 ■█▋ ███▆▬◢◤▼▀ 　　┃
　　　　　　 ▀█▊▼██◥▎　　　　 　　 ◥◣
　　　　　　 ▅██▇▆██　 　　 　▲　　　◥━▪▬▂‗ฺ
　　　　　 ▅█■▀■█▊ 　　　 ▆■◤　　　　　　　　　　━▪▪▬
　　　▂▅█▀　■ 　　▀▇▄▲▆▀▂▃
▄▆▀▀■　 　 ■　 ▅▆▇█▇███■
▀　　　　　　　　▉　 ■▀▀██ 　　　　　　　　　　　　　　　　▂
　　 　 　 　　　　▋　　　　 ██▊　　　 　 　 　▂▄▬▅　◢▆▀▼
　　　　　　　　　▼　 　 　 █▊█▌　▂▄　▅◤ ▐ ▊▀▀ ▐ ▊
　　　　　　　　　 　 　 　 　█▊ █▊ ▐ ▊◢▀ 　 ▐ ▊〓▀　◥▀▅▲
　　　　　　　　　　　　　　　█▊　▼▐ ▊ ▀▇◣▐ ▊
　　　 　 　 　 　 　 　 　 　 ■ 　 　▐ ▊', '　　　　　　　　 　 　 　 　 　 　 /　 　 | 　 　|　 　　|
　　　　　　　　　　　　　　　　　| 　 　 |　 　 |　　 　|
　　　　　　　　　 　 　 　 　 　｜ー　｜ 　 l ー-　 l
　　　　　　 　　　　/⌒ヽ　　　|　 　　|　　 l　 　 　l
　　　　　　　　　 　l　　　l 　 　|　 　 ｜ 　|　 0 　 |
　　　　　　　 　 　 |　　　l　　　| ｰ- 　|　　l⌒) -　l
　　　　 　 　 　 　 |　 -‐|　　　 |　　　 | 　 | 丿 　 |　 　 /⌒ヽ
　　　 　　　　　　　|　　　|　　　 |　　　 |　 |ノ 　 　 l　　 | 　 　ヽ
　　　　　　 　 　 　 l 　　 _!　　　|　　　 !__,! ‐ 　一 |　　 l 　 　 ヽ、
　　　　　　 　 /⌒ヽ l　‐　＼　　|, ﾉ⌒)　()　　 　　l　 　 〉-‐　　l
　　　　　 　　 l〉 　 ）ヽ、　 　ヽノ (ノＯ　(ﾉ　　(つ　ヽ、　|　ﾉ）　 |
　　 　　　　　/　　人　ヽ、　　　　　 　　(⌒)　　 　 　ヽノ （ノ　　|
　 　 　 　 　 l 　　 　ヽ、＼, 　　　　　　　）丿　／　ノ/ o　　　　 l
　　　　　　 　ヽ　　ノ　＼,/　　　　　/　 (ノ　　　　　　　（)　ヽ 　l
　　　　　 　　　＼　　　 /　　　　　　　　／　　　　　(⌒ヽ　　　　|
　　　　　　　　　　ヽ、 　 　 　 ／　　／　 　l 　 　 　しノ 　 　　 |
　　　　　　　　　　　ヽ、　　／　　　/　　 　 |　　 　　　　　　　　l
　　　　　　　　　　　　ヽ、　　　　　　　　　　l　　　　　　　　　　/
　　　　　　　　　　　　　ヽ、　 　　　 　 　 　 | 　　　　　　 　　/
　　　　　　　　　　　　　　ヽ　　　　　　　　 　l　　　　　　　　/', '　　　　　　　　　　　　　　　　　　　　　　　　 ＼●
　　　　　　　　　　　　　　　　　　　　　　　　　　■）
　　　　　　　　　　　　　　　　　　　　　　　　　＜　＼
　　　　　　　　　　　　　　　　　　　　　　　　　　○|￣|_
　　　　　　　　　　　　　　　　　　　　　　　　　●|￣|●|￣|
　　　　　　　　　　　　　　　　　　　　　　　　○|￣|○|￣|○|￣|_
　　　　　　　　　　　　　　　　　　　　　　　●|￣|●|￣|●|￣|●|￣|
　　　　　　　　　　　　　　　　　　　　　　○|￣|○|￣|○|￣|○|￣|○|￣|_
　　　　　　　　　　　　　　　　　　　　　●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|
　　　　　　　　　　　　　　　　　　　　○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|_
　　　　　　　　　　　　　　　　　　　●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|
　　　　　　　　　　　　　　　　　　○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|_
　　　　　　　　　　　　　　　　　●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|
　　　　　　　　　　　　　　　　○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|_
　　　　　　　　　　　　　　　●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|
　　　　　　　　　　　　　　○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|_
　　　　　　　　　　　　　●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|
　　　　　　　　　　　　○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|_
　　　　　　　　　　　●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|
　　　　　　　　　　○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|_
　　　　　　　　　●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|●|￣|
　　　　　　　　○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|○|￣|_', ' [No]

　　　　　　　　　　　　　 ／）　　　　　　　　　,.．-──-
　　　　　　　　　　　／／／）　　　　　　／. : : : : : : : : : ＼
　　　　　　　　　 ／,.=ﾞ\'\'"／　　　　　　/.: : : : : : : : : : : : : : ヽ
　　　／　　　　 i f　,.r=\'"-‐\'つ　　　 ,!::: : : :,-…-…-ミ: : : : :\',i
　　/　　　　　 /　　　_,.-‐\'ﾞ~　　　　 {:: : : : :i \'⌒\'　 \'⌒\' i: : : : :}　　Don\'t think
　　　　／　 　,i　　　 ,二ﾆｰ;　　　　 {:: : : : |　ｪｪ　 ｪｪ　|: : : : :}
　　　/　 　　ﾉ　　　 ilﾞ￣￣　　　　　 { : : : :|　　　> 　 |:: : : :;!　 　 shhsssss
　　　　　　,ｲ｢ﾄ､　　,!,!　　　　　　　　 ヾ: :: :i　r‐-ﾆ-┐ | : : :ﾉ
　　　　　/　iﾄヾヽ_/ｨ"＿＿＿. 　 　 　　ゞイ! ヽ 二ﾞノ ｲゞ
　　　　r;　　!＼ヽi.jl/ﾞﾌﾞ,ﾌヽヾｰtｰ:､__　,ｒ|､｀ \'\' ー--‐ｆ´', '　　 ◢░ 　 ▄▅　　　　　　　　　　　　　　　　　　　　　　▅▄　　░◣
　 ▐░::　 ▀　　　　　　　　　　　　　　　　　　　　　　　　　▀　　::░▍
　▐░::　　　　　 　　　　　　　▂ 　 　 　▂ 　 　　　　　　　　　 　:::░▍　
　 ▌░:: ::　　　　　　　　　　▐::　 　 ▄　 ▀▄　 　　　　　　　 　:: :::░▌
　▐▓░░:: 　　　　　　　　 　 ▋:::　 ▅▀　::░▋　　　　　　　 　::::░▓▌
　 ▐▓▓░░:::: ::　　　　　 　　▊░:::▊ ▊:::░▊　　　　　　　 :: ::::░▓▋
　　 ▀█▓▓░░:::: ::　　　　　　 ▀▀　　▀▀　　　　　　　　:::░▓█▀', 'TIME PARA...∵∴
TIME PA...∵∴∵∴
TI...∵∴∵∴∵∴∵∴∵∴∵∴
TANASINN!!!∵∴∵∴∵∴∵∴∵∴∵∴ヽ
∵∴∵∴∵∴∵∴／￣∵∴∵∴∵∴∴∴∵ヽ
∵∴∵∴∵∴∵∴|　●　|∴∵∴∵∴∵∵∵∴ヽ
∵∴∵∴∵∴∵∴　＿／ ∴∵∴∵∴∵∴∵∴ヽ
∵∴∵／￣￣￣￣　　 ,-‐-､ ∴ ／￣∴∵∵∴∵）
∵∴／　　＼　　　　　/　　　ヽ∴|　●　|∴∵∵∴ﾉ
∵／　　 ＼　＼　　 　l　　　　|　　　＿／∴∵∴ ノ　　　
／　　　＼　＼　　　　 ゝ___,.ノ　　|∴∵∴∵∴∵丿
　　　　　　＼　　　　 ／　　　　　 |∴∵∴∵∴∵ノ
　　　　　　　　　　 ／　　　　　　　|∴∵∴∵∴丿
　　　　 ＼　　　／　　　　 ＼　　 |∴∵∴∵∴ノ
　　　　　　＼／　　　　　＼　＼　|∴∵∴∵ノ
　　　　　＼　＼　　　　＼　＼　　|∴∵∴ノ
　　　　　＼＼　＼　　　　＼　　／∴∵ノ
　　　　　　　　　　 　　　　　　 ／／', '　　　　　　　　　　　　　　　　 \'\'\';;\';\';;\'\';;;,.,　　　　　　　　　　　　　　　　　　ザッ
　　　　　　　　　　　　　　　　　　\'\'\';;\';\'\';\';\'\'\';;\'\';;;,.,　　　ザッ
　　　　　ザッ　　　　　　　　　　　　;;\'\'\';;\';\'\';\';\';;;\'\';;\'\';;;　　　　　　　　　　きょんく～ん、きょんく～ん
　　　　　　　　　　　　　　　　　　　　;;\'\';\';\';;\'\';;\';\'\';\';\';;;\'\';;\'\';;;
きょんく～ん、きょんく～ん　　　 ,.～＾,.～＾,.～＾..～＾ 　　　　　ザッ
　　　　　　　　　　　　　　　　　　 ⌒vv⌒yv⌒vv⌒yv⌒vv、
　　　　　　　　　　　　　　　　, \'´￣｀ヽ －＾, \'´￣｀ヽ －＾, \'´￣｀ヽ　　　　　　　　　きょんく～ん、きょんく～ん
ザッ　　　　　　　　　　　,‐ \'´￣｀ヽ　,‐ \'´￣｀ヽ　,‐ \'´￣｀ヽ　,‐ \'´￣｀ヽ
　　　　　　　　　　　,‐ \'´￣￣｀ヽ＿＿‐ \'´￣￣｀ヽ　＿‐ \'´￣￣｀ヽ　　　　ザッ
　　　　　 　 -‐ \'´￣￣｀ヽ､　　　　 　　-‐ \'´￣￣｀ヽ､　　　　 　　-‐ \'´￣￣｀ヽ､
　　　 　 ／　／" ｀ヽ ヽ　　＼　 　 ／　／" ｀ヽ ヽ　　＼　 　 ／　／" ｀ヽ ヽ　　＼
　　　　//, \'/　　　　 ヽﾊ 　､　ヽ　//, \'/　　　　 ヽﾊ 　､　ヽ　//, \'/　　　　 ヽﾊ 　､　ヽ
　　　 〃 {_{ノ　　　 ｀ヽﾘ| ｌ │ i| 〃 {_{ノ　　　 ｀ヽﾘ| ｌ │ i| 〃 {_{ノ　　　 ｀ヽﾘ| ｌ │ i|
　　　 ﾚ!小ｌ●　　　 ● 从　|、i| ﾚ!小ｌ●　　　 ● 从　|、i| ﾚ!小ｌ●　　　 ● 从　|、i|
　　 　 ヽ|l⊃　､_,､_,　⊂⊃　|ﾉ│ ヽ|l⊃　､_,､_,　⊂⊃　|ﾉ│ ヽ|l⊃　､_,､_,　⊂⊃　|ﾉ│
　/⌒ヽ__|ﾍ　　 ゝ._）　 　j /⌒i !ヽ__|ﾍ　　 ゝ._）　 　j /⌒i !ヽ__|ﾍ　　 ゝ._）　 　j /⌒i !
　＼ /:::::|　l＞,､ __,　イァ/　 /│:;::::|　l＞,､ __,　イァ/　 /│:;::::|　l＞,､ __,　イァ/　 /│
　　/:::::/|　|　ヾ:::|三/::{ﾍ､__∧ |　::/|　|　ヾ:::|三/::{ﾍ､__∧ |　::/|　|　ヾ:::|三/::{ﾍ､__∧ |
　　｀ヽ< |　|　　ヾ∨:::/ヾ:::彡\'　|ヽ< |　|　　ヾ∨:::/ヾ:::彡\'　|ヽ< |　|　　ヾ∨:::/ヾ:::彡\'　|', '　　　　　　　　　　ヽ　/ /⌒＼
　　　　　　　　 ／ヽヽ|/⌒＼ii|＼
　　　　　　　／ ／ヾゞ//／＼＼|
　　　　　　　|／　　 |;;;;;;|/ハ　＼|
　　　　　　　　 　 　 |;;;;/／⌒ヽ
　　　　　　　　 　 　 |;/（　・ω・） Let me down. It\'s not funny.
.　　　　　　　　　　　|｛　∪　　∪
　　　　　　　　 　 　 |;;ヾ.,____,ノ
　　　　　　　　 　 　 |;;; |
　　　　　　　　 　 　 |;;;;;|
　　　　　　　　 　 　 |;;;;;|', '　　　　　　　┌────────────――――――
　　　 　　 　│Maybe a go-kart will make people like me!
　　　 　　　 └─V────────―──―――――　
　　　　　 　　 ∧∧　　　　　　　　　　　　　　(´⌒;;
　　　　　　　 (・ω・ )二二二/ pupupupu(´⌒;; (´⌒
　____ 　／⌒O__　ヽ-==||_　　　　(´⌒;; (´⌒(´´ (´
（;;;（(=二==（;;;◎）--（;;;◎）　(´⌒;; (´⌒(´´ (´⌒;;', '　ｎ..､　　　　　　　　　　　　　　　　　　　　　　　　／￣￣￣￣￣￣￣￣￣￣￣￣
　|:|　゛､ 　　　　　　　　　　　　　　　　　　　　　　|　If I just stare intently into my
　|:|　　| 　　　　　　　　　　　　　　　　　　　　　　|　coffee, I won\'t have to contribute.
　|:|　　| 　　　　　　　　　　　　　　　　　　　　　　＼
　|:|　　| 　　　　　　　　　　　　　　　　　　　　　　　 ￣￣￣○￣￣￣￣￣￣￣
　|:|　　|　　∧＿∧　　　　　　　　∧,,∧　　　　　　　　　　　　o　　∧,,∧
　|:|　 ＼　（　 ﾟ∀ﾟ）　　　　　　　 (ﾟ∀ﾟ+)　　　　　　　 ∧,,∧　　。 (・ω・ )
　|:|　　| ⊂　　　　）　　　　　　　⊂.⊂ ヽｉ　　　　　　(ﾟ　　 ,)　　　O旦⊂）
　H===|.　｜ ｜ ｜　　　　 ./￣￣￣ 旦　￣￣￣⊂\'　|￣￣| ￣￣￣￣￣ヽ.
　I.I.　 II.　（＿_）___）　 　 　 |r────────　r‐,,j______j 　────‐t.|
　　　　　　　　　　　　　　　..||.!!　　　　　　　　　　　　し\'ﾉ/.|ヽ　　　　　　　　.!!||', '
　　　⊂⊃　　／~~＼　　　　　　　.／~~~＼
　　　　　　 ／ 　 　　 ＼／~~＼／ 　⊂⊃..＼　　　⊂⊃　　／~~＼
...............,,,,傘傘傘::::::::傘傘傘:::::..＼:::::::::::::::::::::傘傘.....,,,,傘傘傘::::::::傘傘
　　　　　　　　　　　　　　　　　　　∧_∧
　　　　　　　 　　　　　　　　　　　（・ω・´）　＜Time to hit the road!
　　　　　　　　　　　　　　　　　 　O┬O　)
　　　　　　　　　　　　　　　　　　◎┴し\'-◎ ≡　　　　　　　　　　　　..
" ""\'\'"" "\'\'　""\'\'"""\'\'""\'\'" ""\'\'"" "\'\'\'" ""\'\'"" "\'\'　""\'\'"""\'\'""\'\'" ""\'\'', '　　　　　　　　　　　　 　＿　＿　　　　　　　　　This sucks.
　　　　　∧　　_　- ― ＝￣　￣`:,　.∴.　\'
　　　,　-\'\'￣　　　　　　　　　　　,,::　　　・,\'（・ω・ )、／
　　／　　　-―　￣￣　　￣"\'"　. 　∵. ・と と　 　 )　―
　/　　　)っ 　　　　　　　　　　　　　　　　　<／<／　＼
　( /￣∪', '　　!　　　　　　 i　　　　　　　 　 　 　 |
　　　　i　　　　　|
　 ／ ￣ ＼
　lﾆニニニコ　　.i　　　　　　　　　　　|
　 ＼_＿_／　　　|　　　　|
　　　 | ||i
　　　 | |　　　　|　　　　　i
　　　|￣||　　　i
　　　|　 |i　　 　 　　　　　　　　　　|
　　　|＿|i
　　　 | |　i　 　 　　　　　　　　　　　　　|
　　　 | |　| 　 　 ^　　|
　　　 | |　|　　　　　　　　　＿＿＿＿_＿/　　｀　Will you be my friend?
　　　 | |　　　|　　　　　　| ..｀`‐-､._　　　 ＼
　　　 | |　　　!　　 　　i　 　　　 　｀..`‐-､._　＼
　　　 | |　　　　　i　　. ∧∧　　　 ../ 　　..`‐-､＼
　　　 | |　　 i.　 　|　　( ・ω・)　　/　　∩∩ 　　　| 　　|
　　＿| |＿　　　　　　/　　　 ｏ〆　　(・-・ )
　　|＿＿_|　　　　　　しー-Ｊ　　　　　 uu＿）', '　　　　　　　　　＼　　ヽ　　　　　! |　　　　 /
　　　　　　＼　　　　ヽ　　　ヽ　　　　　　　/　　　　/　　 　 　 ／ .
　　　　　　　　　＼　　　　　　　　　　｜　　　　　　/　　　／
　　　　　　　　　　　　　　　　　　　　 ,イ 　　　　　　　　
　￣　--　　=　＿　　　 　　　　　　/ | 　　　　　　　　　　　　　--\'\'\'\'\'\'\'
　　　　　　　　　　　,,, 　 　 ,r‐、λノ　 ゛i、_,、ノゝ　　　　　-　￣
　　　　　　　　　　　　　　　゛l　　 ∧∧　 　 ゛、_
　　　　　　　　　　　　　　 .j´　　 (・ω・ )　　　（.　Power up!
　　　　　─　　　＿　　─ { 　 　c/◎~ つ 　 /─　　　＿　　　　　─
　　　　　　　　　　　　　　 　) 　　｛ ,、｛ 　　　,l~
　　　　　　　　　　　　　　　´y. 　　lノ ヽ,)　　<', '　　　o　　　。　　　　　　　　　______o　　O　　 。　 　　。　°
　。　○　　o　　　　○　　 ／　　ｨ　　　　　○　　o　　　　○
　　　　　　　　o　　　　　 /ニニﾆ)⌒ヽ　　　　　　　　o
　　　　o　　　　　　　　　 (･ω・ 从__　）　Yay! I found seasonal work!
　　○　　　。　　○　 ／ ○⌒○） ／|,.　o　　　　　　　O　 o
。　　o　　　　o　　 ∠ (／)-( /)_／ ／　　　　　○
　　　　　　o　　　　.|／￣￣ /＿|／　　○　　　。　　o　　O　。
　o　　O　　　　　／∩￣￣/∩　　　o　　　 。
　　　　　　。　 ノ　　　　　 /　　　 o　　　　　　　　　O
　o　　　o　 ψ 　ψ　_ ﾉ)ψ 　ψ___ﾉ)　　　　。　　　o　　　　　　○
　　　o　　 （・(▼)・ ） （・(▼)・ ）　つ　　o　　　°　　　　　 o　　　。
　。　　　o　∪-∪\'"~　 ∪-∪\'"~　　。　　。　o　　　°o　。
　　　　 ＿_　 ＿　。　 　 ＿_ 　 ＿　　o　 o＿_ 　 　 　 ＿　°
　 ＿_ .|ﾛﾛ|／　 ＼　____..|ﾛﾛ|／　 ＼　＿_ |ﾛﾛ| ＿_. ／　 ＼
＿|田|_|ﾛﾛ|_|　ﾛﾛ|＿|田|.|ﾛﾛ|_|　ﾛﾛ|＿|田|.|ﾛﾛ|_|田|._|　ﾛﾛ|＿', '　　This hurts me more than it does you, child.
　　　 ∧__∧　 ∩
　　　（　・ω・)彡☆
　　　　⊂彡☆))-・) ow sorry MOM ow ow sorry OW help me!
　　　　　☆', '+　;
* ☆_+
: ,　xヾ:､__,..-‐‐:､､,へ.........._
　　　　　　　　　く \'´::::::::::::::::ヽ
　　　　　　　 　 /０:::::::::::::::::::::::\',　　I just found religion!
　　　　 　 ＝ 　{o:::::::::( ・ω・)::} 　　Yayyyyyy!
　　　　　　　　　\':,:::::::::::つ:::::::つ
　　　　　　＝ 　　ヽ､_＿;;;;::／
　　　　　　　　　　　し"~(__)', '
　　　　　　　　　　　_,. -‐\'\'"∴∵``\' ‐ .､._
　　　　　　　　　 ,.‐\'´∴∵∴∵∴∵∴∵ `‐.､
　　　　　　　 .／∴∵,;;;;;;;;;ﾐ､∵∴∵ ;:;;;;;;;;∴∵＼
　　　　　　 ,i´∴∵∴∵____:::ヽ∵ /::::____∴∵∴∵ヽ
.　　 　 　 /∴∵∴∵＜.●_>;::∵.:::;く_●＞-.∵∴∵i
　　　　　,i∴∵∴∵∴・｀ｰ\'\'\'\'\'"::;∵:::｀\'\'ー\'\'\'’::∴:∵∴:l
　　　 　 |∴∵∴∵∴∵∴∵::ﾉ::∵∴∵∴∵∴∵∴|
.　　　　 |. ∴∵∴∵∴∵∴/´∴∵;ヾ:∴∵∴∵∴：：|
.　 　 　 |.∴∵∴∵∴∵/（..;=､_/っ..）∴∵∴∵∴∵：| 　 　tanasinn
.　　　　 |∴∵∴∵∴∵´,.,:::::::i:::!::::::,.,｀、∵:∴∵∴∵l
　　　　　l∴∵∴∵∴∵;:;／二ﾆ二ヽ;:;∵∵∴∵∴：l
.　　　　　ﾞi ∴∵∴∵∴∵ヽ｀\'\'ｰ-‐\'\'ソ∴∵∴∵∴：i
　　　　　　ヽ∴ ∵∴∵∴∵゛\'\'\'\'\'\'\'"∴∵∴∵∴∵/
　　　　 　 　 ＼∴∵∴∵∴∵∴∵∴∵∴∵／
　　　　　　　　　`‐.､∴∵∴∵∴∵∴∵∴,.‐\'´
　　　　　　　　　　　 `:‐.､.：：∴∵∴∵.-‐\'\'"', '\'-._　　　／~~＼⊂⊃　___.....___　　　　⊂⊃　　／~~＼
　　`.__／　　　＼ ,-\'　　　　,-.`-,　　　　　 ／ 　　＼／~~＼／
　　　　`\'\'-------\'　　　　　( p )　`._.........,,,,傘傘傘::::::::
　　　　　　　　　　　　　　　`-\'　　　(　　　　∧_∧
　　　　　　　　　　　　　　　　________|　　（・ω・ ）　＜ NOOOOO!
　　　　　　　　　　　　　　　./　　　　　　　O┬O　)
　　　　　　　　　　　　　　　＼^^^^^^^^^　　　◎┴し\'-◎ ≡
...................._　　　　　 --...--,
　　　　　　　　　　 `-.._　　　　 _.-\'""""" ""\'\'"""\'\'""\'\'" ""\'\'""
　　　　　　　　　　　　　`\'-----\'\'', '　　　　ｷﾞ､ｷﾞ､ｷﾞｼｷﾞｼ ♪
　　　　　　＼ｱﾝ、ｱｱﾝ、ｱ､ｱﾝ／
　　　　　　　♪　(・ω・) Maybe I should get back into ja-ja-ja-jazz
　　　　　　　 ＿ ノ　 )>＿ I heard that\'s where the money\'s at-at-at-at
　　　　　　／.◎。／◎｡／|
　　　　　　|￣￣￣￣￣|', '　　　　　　　　　　　　　　　,;\'\'\';,
　　　　　　　　　　　　　　,;\'　　\';, ,.,.,,.,.,　　　 ,,
　　　　　　　　　　　　　 ,;\'　　 　 　　　｀"\' ;\'　\';,
　　　　　　　　　　　　　;\'　　　 ●　　　　　 　､\',
　　　　　　　　　　　　　;　　　　　　( _ ,　 　● .;　 I\'m bigger than life!
　　　　　　　　　　　　　,\'､　　　　　　　｀ｰ\' 　　;\'　 　　
　　　　　　　　　　　 　;\'　,　　 　 　 　 　 　 .,; \'
　　　　　　　 ,; \'\'　;,　,;\',　\'　　　　　　　　"　"\';
　　　　　　　;\'　　　"　　　　　　　　　　　 　　:; . . . . .
　　　　　　　;:　　,　　　　　 　 　 　 \'" " ;\'　　:;:. :. :. :. :.
　　　　　　　\' ､,.;\' ､,.,.　 　　　 　　　　　 ; "\'\'\'\'".: .: .: .:.....
　　　　　　　　.: .: .: .:｀"\'\' - ､,.,. ,,.,.,;\'　　;\'.: .: .: .: .: .....
　　　　　　　　　 　...: .: .: .: .: .: .: .: ､,.,.;\'.: .: .: .: .:.....
　　　　　　　　　　　　　....: .: .: .: .: .: .: .: .: .:.....', '∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵。∴∵
∴∵∴∵:。∴∵∴∵∴: --─-　∴∵∴∵∴∵∴∵
∴∵゜∴∵∴∵∴∵　 （___ ）（___ ）　∴∵。∴∵∴∵　゜
∴∵∴∵∴:∵∴∵_　i/ ＝　＝ヽi　∴∵∴∵。∴∵∴
∴∵☆彡∴∵∵ ／/[||　 　 」　　||]　∴:∵∴∵∴∵:∴∵
∴∵∴∵∴∵　/　ﾍ　| |　 ____,ヽ | |　∴:∵∴∵∴∵:∴∵
∴ﾟ∴∵∴∵ ／ヽ ﾉ　 　 ヽ＿＿./　　∴∵∴∵:∴∵∴∵
∴∵∴∵　 く　 /　　　 　三三三∠⌒＞　∴:∵∴∵:∴∵
∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∵∴∵∴∵
　　 ∧∧　 　∧∧　　∧∧　 　∧∧
　　（　　 ）ゝ （　　 ）ゝ（　　 ）ゝ（　　 ）ゝ　To boldly go where no man has gone before! Tanasinn space!
　　 i⌒　/ 　 i⌒　/ 　i⌒　/ 　 i⌒　/
　　 三　 |　　三　 |　　三　 |　　三 　|
　　 ∪ ∪　　∪ ∪　　∪ ∪　　∪ ∪
　　三三　　　三三　　三三　　三三', '　　　 　 ,r,ニﾆ =､.　　　　　　　,. -―r－-- ､＿＿___
　　　　//　　　｝　i　　　　　.／　 ／　　　　　 ヽ- ＼　ヽ
.　　　//　 ,r ⌒ヽ.}　　　 ／　 ／ ＿＿__ ＿___. Y 　 ＼. ＼
..　　//　 /　　　 .{　　　厶--くr\'´: : : : : /:.:: : :.::＼ニｰ ､＼ } ,. -‐ｧ‐-､
＿_,,〉ﾄ___ﾍ＿＿___l＿,/ ｛ /￣厂了フｰ\'､￣＼___;.:＼｀ー:.￣: :.／:.: : : :ヽ　　　　　＿
＿＿＿＿＿＿______丿　.＼　{　 {　|　 厂 ＼: :く_／´ｽト:､__／:: : : : : : : :{´了＾厂/ /⌒ヽ ＿＿
　 \'/ {　r王i|　　 　 ヽ-､　　 ＞､ !. |　ﾉ 　 厂`ｰ､ヽｲｰ||ノ＼: :;r=ﾆﾆヾ￣ ヾﾆヽ,／￣ /＿＿_
　{.ト┴～jK|　　　 　 l|　`～\'|: : :.｀ ー{.　 /　 ／￣＞､:. : .:_r＜_￣ ＼⌒ヽ￢､-､}仁Ｋ /
.　!.l.　　　　 |　　　 　 l. 　 　 |: : : : : :.::.ヽ｛　/　 ／ 　 入,rﾍト ､ _ ＼､ ＼.　＼.ヽY仁ﾄ､ヽ
　 ヾ;､　　　 j　　　_. /　　　　|: : : : : : :.::.:ヽ |　 / 　 ノ　fべ ヾミド､≧≫\'`7ﾞﾃ =;xi {Ｋ二i ﾊ
　　　ヾ＝‐\' |　／　/　　　　　＼: : : : : : :.::.:＼.|　 / 　 ,r\'トミト>\'７^／ ,　/ /　./ }\'＾ヾ;三Kﾊ
　　　　　 　 ∨　　 |　　　　　　　＼: : : : : : :.::.:ヽ | 　 /{. ≧ｼ\'／イ/! / /,.ｲ　,1 /!　　 ㍉ﾆ人
　　　 　 　 　 l.　　 !　　　　　　　 / ＼: : : : _: : : :￣ {:∧ 〃/ /∠ r十{-|､i / |/ }ｉ.|　 　 Yヽﾉ
　　　　　 　 　 l　　　 　 　 　 　 /　 　 ｀丁　＼__ ／|:!　ト!/ / _,.==､乂 　 |{　{　川 ｲ\'　　V{
　　　　 　 　 　 ｌ　　　　　　　　/　　　 　 |　 　 　 　 ﾄ{　| l　 ｀Y\'じｿ;バ　　　　 /ｲハ|　i! i ﾄ!
　　　　　　　　　ヽ　　　 　 　 /　 　 　 　 |　　 　 　 {Y〉ｉ| l 　 ヾ辷r\'　　　 　 ,.=x/ //　ii. } !|
　　　　　　　　　　 ヽ.　　 　 /　　 　 　 　 | 　 　 　 〈ﾍ〉}jl,ﾊ　　　　　　　　 /し\';ﾊ ,人 ﾉiｲ,ﾊ!
　　　　　　　　　　 　 ` ー \'　 　 　 　 　 　 !　 　 　 〈Y〉＼　ヽ　 ,.ヘ. _ ,　 ヾﾝ\',.イ|〈Y）,〃 ﾉ
　　　　　　　　　　　　　　　　　　　　　　　　ヽ.　　　〈ﾍ〉　ﾉヽ　ヽ.ｰ\'´__ ___.／　| | {Y〉
　　　　　　　　　　　　　　　　　　　　　 　 　 　 ＼　〈Y〉 /　 |　 　 　 ｲ 　 | 　 l　| | {Y〉
　　　　　　　　　　　　　　　　　　　　　　　　　　　 ヽ{Y;〉　　 |ヽ.　　　||　　| 　 |　! !〈Y〉
　　　　　　　　　　　　　　　　　　　　　　　　　　　　 ﾄ;;1　 　 ヽ.|　 　 ﾊ.　/　 / //| {Y〉
　　　　　　　　　　　　　　　　　　　　　　　　　　　　{.i.ｉ ｝　 　 /.|　　 　 } i| 1/ ////{Y〉
　　　　　　　　　　　　　　　　　　　　　　　　　　　　j从{､　,/ /　　　　l ﾊ/l /ｲ.j/ 〈Y〉
　　　　　　　　　　　　　　　　　　　　　　　　　　　〃((フLに)）{.　 　 　 ﾘ　,ﾉ′〃　/Y〉
　　　　　　　　　　　　　　　　　 　 　 　 　 　 　 〃__{{_玉X!　./　　　　　　　　　　　トｲ
　　　　　　　　　　　　　　　　　　　　　　　　　 /,\'　　 　 ＼_ /　　 　 　 　 　 　 　 ｛从）
　　　　　　　　　　　　　　　　　　　　　　　　　 {.{　　　　　 ノ
　　　　　　　　　　　　　　　　　　 　 　 　 　 　 ヾ_ｰ--_\'／
　　　　　　　　　　　　　　　　　　　　　　　 　 　 　 ￣', '　　　　　　　　　　　　　　　　(⌒) 　　　　　　(⌒) 　　　　　(⌒)
　　ｷﾀ━━━━━━（ﾟ∀ﾟ）ﾉﾉ━━　（ﾟ∀ﾟ）ﾉﾉ━━（ﾟ∀ﾟ）ﾉﾉ━━━ !!
　　　　　　　　　　　／　　　／　　 　／　　　／　　／　　　／
　　　　　　　　　　　し\'|　　｜　 　 　し\'|　　｜　　　し\'|　　｜
　　　　　　　　　　　／／＼＼ 　　　／／＼＼ 　　／／＼＼
　　　　　　　　　　（＿）　　（＿） 　（＿）　　（＿） （＿）　　（＿）', '　　　　　　　 　　　　　　　　　∴
　　　　　　　　 ∵ 　∴　　∴∵∴　　　　∴
　　　　　∴∵∴∵∴∵∴∵∴∵∴∵∴∴∵
　　　　　　　∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵
　　　∴∵∴∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴
　 　 　 ∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵/ ⌒ヽ∴∵∴∵∴
　 　 ∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵| | 　　|∴∵∴∵
　 ∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∪ / ﾉ∴∵∴∵∴∵
..　 ∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵| ｜|∵∴∵∴∵
.∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∪∪∴∵∴∵∴∵
.∵∴∵∴∵∴∵∴∵：(･)∴∴.(･)∵∴∵∴∵∴∵∴∵∴∵∴∵∴
∵∴∵∴∵∴∵∴∵∴／ ○＼∵∴∵∴∵∴∵∴∵∴∵∴
..∵∴∵∴∵∴∵∴∵/三　|　三ヽ∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵
.　∴∵∴∵∴∵∴∵ |　＿_|＿_　│∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵　　　　　tanasinn
.∵∴∵∴∵∴∵∴∵|　　===　　│∵∴∵∴∵∴∵∴∵∴∵∴
.∵∴∵∴∵∴∵∴∵＼＿＿＿／∵∴∵∴∵∴∵∴∵∴∵∴
..∴∴∵／￣.. ＼∴∵∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴
∴∵∴/　　　　,. i ∵∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵
∴∵∴|　　　 /.| |.∵∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵
　 ∵∴|　　　| ：| |.∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴
　 　 ∴|　|　 |：：| |.∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵
　 　 ∴| ｜　|∵Ｕ∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴
　 　 　 | ｜　|∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵
　 　　 / /　/ ∵∴∵∴∵∴∵∴∵∴∵　∵
　　　 / /　/ 　　　　　　∴∵∴∵∴　∴
　　　.しし’　　　　　　　　　　∵', '　 　 　 /＼
　 　 ／∵∴＼
　　 /∵∴∵∴∵＼　 　　　　In Marty\'s DQN Cafe\'
　／∵∴∵∴∵∴/＼　 　　　　you can just not think, feel
　＼＼∵∴∵∴∵∴＼　　　　　　and you will be tanasinn.
　　 ＼∵∴∵/ 　 　 　 ＼　　　　　　　　　
　　　　＼／ 　 　　　　　＼
　　　　　　　　　 ∧∧∧∧＼　　　　　　　　　　It\'s T∵∴∵∴∵∴∵ QUALITY!
　　　　　　　　　（　 ´／）　））ヽ∧　　　　　　　∴∵p://∵∴∵et∵qn/
　　　　　　　　 ／ 　 ／　　/ ´∀） ∧∧
　　　　　　 ○(　　 ｲ○　 （　　　,つ, ,ﾟДﾟ)
　　　　　　　／ヽ　 )） ヽ　 )ヽ　)と　　, ｲ
　　　　　　 （_／（_/(／（/ﾉ（_/⊂ﾉ> )Ｊ
　　　／￣Y￣｀|/￣＾Y￣ヽ/￣￣Y ｀´￣＼', '　　　　　　　　　　　 ,ノ‐\'\'\'\'\'\'^¨¨¨⌒￣⌒^^\'\'￢-､,
　　　　　　　　.v-\'\'¨｀.,,vｰ─-､　　　 .,,vｰ─-､　 .¨\'ｰu
　　　　　　_ノ\'″　　./′　　　 ¨┐ .／　　　　 ﾞ\'┐　　 .ﾞ\'┐
　　　　 ,／′　　　./　　　　　　 .ﾐ .i′　　　　　 .）　　　　 ﾞ＼
　　　 ,/′　　　　　|　　　　　●　| ｝ _●,　　　　 |　　　　　　＼
　　 ./′　　　 .,,､-ﾐ.　　　　.　　/¨ﾚ　　　 　　 .人,　　　　　　ミ
　 .,ﾉ′　　.ノ\'″　　＼_　　 .,rlﾄ冖へy　　　_／　 ¨\'‐u　　　　 .ﾞlr
　.,i′　　／ｰ-v､.,,_　　 ¨^^¨´〔　　　 〕.¨^^¨′　　__.,､ ﾞ＼.　　　 ｛
　〕　　 ./′　　　　.⌒\'\'\'\'\'　　　 ＼,,,,,,ノ′　 v-ｰ\'\'\'¨′　　　ﾞ┐　　 ｝　　　　
　|　　 ﾉ　 .────ｰ　　　　　　｝　　　　　 __,,.,､v--ｰ\'\'　　｛　　 .］　　
　|　　:|　　　　　　　 .__,..　　　　　 .!　　　　　 ｀　　　　　　　　.｝　　.｝　
　｝　 .|　　 .--:;:冖^￣　　　　　　 .|　　　　　 ¨¨¨¨¨¨ﾞﾌ¨¨′ .｝　　｝　　
　.|　 .｝　　　　.＼_　　　　　　　　 .｝　　　　　　　　._／　　　　｝　 .:|　　　　
　 ).　.〕　　　　　 .ﾞﾐzu,_　　　　　　｝　　　　　 _,ノ┘　　　　　 ｝　 /
　 .｛　 ).　　　 .,/\'″　 ¨ﾞ(ｧv､,　　.!　 .,,,,v‐\'^′　　　　　　 ,ﾉ　 ﾉ
　　 ﾐ.　7,　　 .iﾞ　　　　　 〔　　｀¨¨^^⌒　　　　　　　　　　 ,ﾉ′,/
　　　ﾞ).　ﾞli.　_ﾉi.　　　　　ﾉ　　　　　　　　　　　　　　　　 .,r′.,ﾉ
　　　　＼ ﾞ>\'′^ｰ､､､v‐′　　　　　　　　　　　　　　　.,r′ ／
　　　　 .|／　　　　　　｝　　　　　　　　　　　　　　　　./′,／
　　　　./′　　　　　 ,i¨¨¨¨¨¨ﾞソ冖干ｱ^^^^^^^^^^^|　r\'′
　　　 .,i′　　　　　 ./￢冖\'\'\'\'\'7′　　　∨￢ｰｰz─-「　＼
　　　 .｝　　　　　　_ﾉ　　　　　厂¨丁¨¨ﾌ　　　　.ﾐ､　　　　ﾞ＼
　　　 .〔　　　　　./′　　　　　ﾞ\'-､..!,,ノ\'′　　　　 ﾞ).　　　　　ﾞ).
　　　　｛.　　　　.ﾉ　　　 ､､､､､､､､､､､､､､,,,,,,,,,,､.,　　〕　 .､　　　｛
　　　　 .〕　　　 .］　　　 .|　　　　　　　　　　　 .〕　　|　　ﾞl!　.,／⌒┐
　　　　　｛　　　 .|　　　　|_　　　　　　　　　　 ,ﾉ　　,｝　　 ﾚ\'\'′　　 .｝
　　　　　 〕　　　 ).　　　 .ﾞ＼_　　　　　　　,,r\'\'′　丿　　 八,　　　_,ﾉ
　　　　　 .〕　　　 .＼_　　　　^\'\'ｰ-vvv-ｰ\'″　　,,ﾉ　　　 ］　¨\'ｰ\'\'\'″
　　　　　 .:|　　　　　 ^\'ｰv.,_　　　　　　　　 _,ノ\'″　　　　｝
　　　　　 .｝　　　　　　　　 ¨ﾞ\'\'￢ｰ----ｰ\'\'″　　　　　　 ］
　　　　　 .｝　　　　　　　　　　　　」　　　　　　　　　　　　.|
　　　　　,r冖￢￢￢￢～----ｰ《､､､､､､､､､､､､､､,,,,,､.....|
　　　　 r′　　　　　　　　　　　　|　　　　　　　　　　　　 .ﾘ.
　　　　 .＼,,　　　　　　　　 .,,,vrh､､,　　　　　　　　　　 .）
　　　　　　　¨^^\'\'\'\'\'\'\'^¨^^\'\'\'\'\'\'¨′　　　 ⌒^^^\'\'\'\'\'\'\'\'\'\'\'^¨¨¨⌒″', 'ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●
●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ
ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)
)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・
・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀
∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・
・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ(
(・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ
ヽ(・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●
ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●
●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ
ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)
)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・
・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀
∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・
・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ(
(・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ
ヽ(・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●
ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●
●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ
ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)
)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・
・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀
∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・
・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ(
(・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ
ヽ(・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●ヽ( ・∀・)ﾉ●', '　　　／⌒ヽ
　　/　´_ゝ`） 　I think it\'s gonna rain soon.
　　|　 　　/
　　| /|　|
　 //　| |
　Ｕ　 .Ｕ', '　　　　／￣|
　　　　|　　｜
　　　 ｜ 　｜.　∧＿∧
　 ,―　　　　＼<ヽ｀∀´>
　| ＿＿_） 　 ｜　　ノ
　| ＿＿_） 　 ｜）＿）
　| ＿＿_） 　 ｜
　ヽ＿＿）＿／', '　　　　 　　　／⌒ヽ　　　　
　　　　 　　/（●）（●） 　　excuse me may i pass through here
　　　　 　　|　ﾄｪｪｪｲ/　　　
　　　　 　　| /｀ﾆﾆ´　　　　
　　　　 　 //　| |　 　　　　
　　　　 　Ｕ　 .Ｕ　 　
　_,,..-―\'"⌒"~￣"~⌒ﾞﾞ"\'\'\'★　　　　　　　　　　　　　　　　
ﾞ~,,,....-=-‐√"ﾞﾞＴ"~￣Y"ﾞ=ﾐ
Ｔ　　|　　 l,＿,,/＼　,,/l　　|
,.-r \'"l＼,,j　　/　 |/　 L,,,/
,,/|,／＼,/　,|＼_,i,,,/ ／
V＼　,,/＼,| 　,,∧,,|/', '　　　　(wink!)
　　　 　　 ＼　　,＼⌒／、　　　　　　Don\'t worry, young man.
　　　　　　　 ` （≫ヽへ◎）_,,～~
　　　／⌒ヽ,,-―|,-+‐,　|、　　　You might say there\'s a little DQN in all of us.
　　/（●）（●）　||-+-|　| |
　　|　ﾄｪｪｪｲ/　　|(※)= | ^
　　| /｀ﾆﾆ´　 　 |,・--、|
　 //　| | 　 　 　∥ 　 ∥
　Ｕ　 .Ｕ　　　　| 　 　 |', '　　　　　　　　　　　　　　　　　rｰィへ个ﾍ、
　　　　SASUGA DESU!　　ﾉ ヽ !　 ﾉ　ノ＾ゝ
　　　　　　　　＿＿　　　　　ゞ／´￣￣｀ヽ/､ヽ
　　　 __／￣　　　　 ＼　 　 // // ハ、ヽl　|　|
　　 ｢ /　｢　ｒ ,　 ﾊヽ ヽヽ　 ヽ!-Ｈ‐ﾄ､|ヤＨ ｌ|　|
　　 ｣｛三|　| ﾒ､/ﾘﾚＸ7ﾉ ｝　　 | TU　　Ｕﾌ| ||　|
　　//{ニ|　|/ ＞　 ＜ {lﾉ　 　 ヽ|、 --　ノﾚﾘ ﾉ
　　7　| （|⊂つ （￣）rぅ |　　　 ｒ〈＞ﾊ＜/⌒ヽ、
　　＼,| l､＼| `ｰr､＜ﾉ リ　 　 / /に{_}こ}　　　}
　　　　>そ !￣＼ |l`〈´ﾇ　　 / 〈　くハゝ〉 　 ノ
　　　 {/ て｛＿＿Y_,ﾉ ﾉ }　　ヽ、ゝ　　 /　 /、
　　　/　　rへ、　　/ ￣￣￣￣￣ /　/　 ハ＼
　　 /　／＼ノ　　/ /￣ /ﾚ/ / / / Ｖ　 /　 l　 ヽ
　　〈 ´ 　 　 >___/ /￣ /　/　ﾚ\' / </⌒>　　|／
　￣￣￣￣ └┴―――――┘￣￣￣￣￣￣￣', '　　　-‐‐- 、
／　　　　　ヽ
!　 !　人|,.iﾉl_ﾉ）
i 　乂-‐　－! i 　 Did somebody say something?
＼ヽ .ゞ　- ﾉノ 　 Hm, must have been the wind.
　　｀｀フ　i´
　 　 / ＼ﾉゝ 　
　　/__i |丱!|
━━つ━つ━━∞∞∞========
==　　 TEH REI\'S DINNOR　 　==
∞∞∞∞∞∞∞∞∞∞∞∞∞∞', '　　　♩　　♬　　　　♭　　　　　♪　　　　　♬　　　　♩　　♬　　　　
　　　-‐‐- 、　　　♪　　　　♩　　♬　　　　　　　　♭
／　　　　　ヽ　　　　　♭　　　　　♪　　　　　　♫　　　♩
!　 !　人|,.iﾉl_ﾉ）　　　♪　　♩　　　　　♫　　　　　♩
i 　乂-‐　－! i 　 Aaaah~　　　♭　　　　♪　　♭
＼ヽ .ゞ　ヮ ﾉノ 　 Finally, peace!, a chance to listen to birds singing
　　｀｀フ　i´　　Freedom from the idiots!　　　　♫　　　♩
　 　 / ＼ﾉゝ 　　　♩　　♬　　　　♭　　　　　♪　　　　　♬　
　　/__i |丱!|　♪　　　♭　　　　　♪　　　　♫　　　♩
━━つ━つ━━∞∞∞========
==　　 TEH REI\'S DINNOR　 　==
∞∞∞∞∞∞∞∞∞∞∞∞∞∞', '　　　へ-ﾍ
　　 ﾐ*´ｰ｀ﾐ
　～(,_ｕｕﾉ
／　　　　　ヽ
!　 !　人|,.iﾉl_ﾉ）
i 　乂-‐　－! i 　
＼ヽ .ゞ　- ﾉノ　 Sorry, we don\'t serve the mentally challenged.　
　　｀｀フ　i´
　 　 / ＼ﾉゝ
　　/__i |丱!|
━━つ━つ━━∞∞∞========
==　　 THE REI\'S DINER　　 　==
∞∞∞∞∞∞∞∞∞∞∞∞∞∞', '　　　へ-ﾍ
　　 ﾐ*´ｰ｀ﾐ Are we following all the labor regulations here, nya?
　～(,_ｕｕﾉ、
／　　　　　ヽ
!　 !　人|,.iﾉl_ﾉ）
i 　乂-‐　－! i 　
＼ヽ .ゞ　- ﾉノ　　
　　｀｀フ　i´
　 　 / ＼ﾉゝ
　　/__i |丱!|
━━つ━つ━━∞∞∞========
==　　THE REI\'S A MINOR　 　==
∞∞∞∞∞∞∞∞∞∞∞∞∞∞', '　　　へ-ﾍ
　　 ﾐ*´ｰ｀ﾐ
　～(,_ｕｕﾉ、
／　　　　　ヽ
!　 !　人|,.iﾉl_ﾉ）
i 　乂-‐　－! i 　< What labor regulations?
＼ヽ .ゞ　- ﾉノ　　
　　｀｀フ　i´
　 　 / ＼ﾉゝ
　　/__i |丱!|
━━つ━つ━━∞∞∞========
==　　THE REI\'S A MINOR　 　==
∞∞∞∞∞∞∞∞∞∞∞∞∞∞', '　　　-‐‐- 、
／　　　　　ヽ
!　 !　人|,.iﾉl_ﾉ）
i 　乂-‐　－! i 　 We don\'t serve musicians. This is a clean establishment.
＼ヽ .ゞ　- ﾉノ
　　｀｀フ　i´
　 　 / ＼ﾉゝ
　　/__i |丱!|
━━つ━つ━━∞∞∞========
==　　 THE REI\'S DINER　　 　==
∞∞∞∞∞∞∞∞∞∞∞∞∞∞', '　　　-‐‐- 、
／　　　　　ヽ
!　 !　人|,.iﾉl_ﾉ）
i 　乂-‐　－! i 　 Sorry, we don\'t serve tiny penis here.
＼ヽ .ゞ　о ﾉノ
　　｀｀フ　i´
　 　 / ＼ﾉゝ
　　/__i |丱!|
━━つ━つ━━∞∞∞========
==　　 THE REI\'S DINER　　 　==
∞∞∞∞∞∞∞∞∞∞∞∞∞∞', '　　　-‐‐- 、
／　　　　　ヽ
!　 !　人|,.iﾉl_ﾉ）
i 　乂-‐　－! i 　 Please head to the next window.
＼ヽ .ゞ　- ﾉノ
　　｀｀フ　i´
　 　 / ＼ﾉゝ
　　/__i |丱!|
━━つ━つ━━∞∞∞========
==　　 THE REI\'S DINER　　 　==
∞∞∞∞∞∞∞∞∞∞∞∞∞∞', '　　 -‐‐-
　/　　　　　＼　　　Oooo, I\'m soooo scared...
　|　　-‐　－ i　　　　
　＼　 　- 　ﾉ　
　　｀｀フ　i´
　 　 / ＼ﾉゝ
　　/__i |丱!|
━━つ━つ━━∞∞∞========
==　　 THE REI\'S DINER　　 　　==
∞∞∞∞∞∞∞∞∞∞∞∞∞∞', '　　　　　　 ＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿_
　　　　　 ./　/　/　/　/　/　/　/　/　/　/　/　/　/ヽ
　　　　　/　/　/　/　/　/　/　/　/　/　/　/　/　/`､ ヽ
　　　　./　./　┌──────────── === 、ヽ
　　　 /＿/_ /｜Wow, this stuff is great!
　　　|=ら ギ_ └v┬─────────────
　　 |= ∫　 =:|　||. |　Real food, at last!
　　 |= め コ..:|　||　＼＿＿＿　 ＿＿＿＿＿..┌─────────────
　　　|=ん　=:| 　|| ｸﾞﾂｸﾞﾂ.　　∨　　 ∧ ∧.　|| |　Opening up across the street
　　　~~~~~~~ |　|| 　 ==┻==　　　　（ﾟДﾟ；） ＜　 from Rei\'s was a genius move!
　　　 　 　　 ｜.∧ ∧|￣￣|∧＿∧（|ギ∪　|| ＼＿＿＿＿＿＿＿＿＿＿＿＿＿
　　　　 　 ┌┴（　　 ）――（　　　　）　――┸┐
　　　　 ┌┴―/　　| ――.（　　 　 ）――――┴┐
　　　　 └‐.～(＿ﾉ――.（_＿○,,） ―――┬―┘
　　　　　　　 | |￣￣|　　　( |￣ ￣| 　　 .....:.::::|　　　
　　　　　　　 | |　 　 | 　..:::::::| 　 　 | ...::.::.:..::::::::|　　　
　~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ ', '　　　-‐‐- 、
／　　　　　ヽ
!　 !　人|,.iﾉl_ﾉ）
i 　乂-‐　－! i 　I\'m not in this business to make friends,
＼ヽ .ゞ　- ﾉノ　little Suzy Creamcheese.
　　｀｀フ　i´　　　
　 　 / ＼ﾉゝ
　　/__i |丱!|
━━つ━つ━━∞∞∞========
==　　 THE REI\'S DINER　　 　==
∞∞∞∞∞∞∞∞∞∞∞∞∞∞', '　　　-‐‐- 、
／　　　　　ヽ
!　 !　人|,.iﾉl_ﾉ）
i 　乂-‐　－! i 　What else can do I do with a degree in Modern Image Board Culture?
＼ヽ .ゞ　- ﾉノ　That\'s like asking a Liberal Arts major why they serve Coffee.
　　｀｀フ　i´　　　
　 　 / ＼ﾉゝ
　　/__i |丱!|
━━つ━つ━━∞∞∞========
==　　 THE REI\'S DINER　　 　==
∞∞∞∞∞∞∞∞∞∞∞∞∞∞', 'ﾟ　　-‐‐- 、ﾟ
／　　　　　ヽﾟ ﾟ
!　 !　人|,.iﾉl_ﾉ）ﾟ
i 　乂-‐　－! i ﾟ We\'r- hic fresh.. outta th-hic-at
＼ヽ .ゞ　- ﾉノ
　　｀｀フ　i´
　 　 / ＼ﾉゝ
　　/__i |丱!|
━━つ━つ━━∞∞∞========
==　　 THE REI\'S DINER　　 　==
∞∞∞∞∞∞∞∞∞∞∞∞∞∞', '　　　-‐‐- 、
／　　　　　ヽ
!　 !　人|,.iﾉl_ﾉ）
i 　乂-‐　－! i 　Full frontal nudity is not part of my job description.
＼ヽ .ゞ　- ﾉノ　　
　　｀｀フ　i´　　　
　 　 / ＼ﾉゝ
　　/__i |丱!|
━━つ━つ━━∞∞∞========
==　　 THE REI\'S DINER　　 　==
∞∞∞∞∞∞∞∞∞∞∞∞∞∞', '　　　へ-ﾍ
　　 ﾐ*´ｰ｀ﾐ
　～(,_ｕｕﾉ
／　　　　　ヽ
!　 !　人|,.iﾉl_ﾉ）
i 　乂-‐　－! i 　
＼ヽ .ゞ　- ﾉノ　 Security kitten, get these pedantic, overly
　　｀｀フ　i´ verbose freaks out of here!
　 　 / ＼ﾉゝ
　　/__i |丱!|
━━つ━つ━━∞∞∞========
==　　 THE REI\'S DINER　　 　==
∞∞∞∞∞∞∞∞∞∞∞∞∞∞', '　　　-‐‐- 、 　　
／　　　　　ヽ　　　
!　 !　人|,.iﾉl_ﾉ） 　
i 　乂-‐　－! i 　 We\'ve known each other for years, and
＼ヽ .ゞ　- ﾉノ 　you haven\'t noticed that I\'m completely emotionless?
　　｀｀フ　i´　　　　
　 　 / ＼ﾉゝ　　Jeez, you\'re dumb.
　　/__i |丱!|　　
━━つ━つ━━∞∞∞========
==　THE REI\'S DINER　　　　 　==
∞∞∞∞∞∞∞∞∞∞∞∞∞∞　', '　,/＼ﾞ-―-/￣/
/　＼　ｖヘ/　/ヽ　　　No, but you can get banned.
|　 /　＼/＼ﾉ　　 ﾞ　　　
　　彡ﾞ丶´ｿ＼　彡　
　《　（・ 　・）　ﾉソ彡
　/　　　 ゝ　　|彡
　＼＿∟＿／
　　｀｀フ　i´　　　　
　 　 / ＼ﾉゝ　　
　　/__i |丱!|　　
━━つ━つ━━∞∞∞========
==　W. T. Snacks-chan\'s Diner　　　　 　==', '　　　-‐‐- 、
／へ　　　　ﾍ
!　 !　人|,.iﾉl_ﾉ）　　
i 　乂-‐　－! i
＼ヽ ﾐ*　ｰ ﾐノ 　Hello, Rei has fainted, I am Rei Kitten. How may I help?
　　｀｀フ　i´
　 　 / ＼ﾉゝ
　　/__i |丱!|
━━つ━つ━━∞∞∞========
==　　 THE REI\'S DINER　 　==
∞∞∞∞∞∞∞∞∞∞∞∞∞∞', '　　　　　　ζ
　　　 ／￣￣￣￣＼
　　 /　　　　　　　　　＼
　　/＼ 　　＼　　　／｜
　　|||||||　　　(･)　　(･) ｜
　　(6-------◯⌒つ｜　　
　　｜　　　　＿||||||||| ｜ 　
　　　＼　／　＼＿/ ／ 　　That\'s what happens when I go senile! Ha! Ha!
　　　　 ＼＿＿＿_／
　　　　 　 / ＼ﾉゝ
　　　　　/__i |丱!|
　　　━━つ━つ━━∞∞∞==========', '　　　-‐‐- 、
／　　　　　ヽ
!　 !　人|,.iﾉl_ﾉ）　　　That is not an English w, why did you carry it?
i 　乂-‐　－! i
＼ヽ .ゞ　- ﾉノ
　　｀｀フ　i´
　 　 / ＼ﾉゝ
　　/__i |丱!|
━━つ━つ━━∞∞∞========
==　　 THE REI\'S DINER　　 　==
∞∞∞∞∞∞∞∞∞∞∞∞∞∞', '　　　-‐‐- 、
／　　　　　ヽ
!　 !　人|,.iﾉl_ﾉ） Sorry, all our private areas of VIP QUALITY have been reserved.
i 　乂-‐　－! i
＼ヽ .ゞ　- ﾉノ
　　｀｀フ　i´
　 　 / ＼ﾉゝ
　　/__i |丱!|
━━つ━つ━━∞∞∞========
==　　 THE REI\'S DINER　　 　==
∞∞∞∞∞∞∞∞∞∞∞∞∞∞', '　　　-‐‐- 、
／　　　　　ヽ
!　 !　人|,.iﾉl_ﾉ） Security kitten, are you around? The counter
i 　乂-‐　－! i　　display is acting strange again.
＼ヽ .ゞ　- ﾉノ
　　｀｀フ　i´
　 　 / ＼ﾉゝ
　　/__i |丱!|
━━つ━つ━━∞∞∞========
==　XML Parsing error: syntax e=
∞∞∞∞∞∞∞∞∞∞∞∞∞∞', '　　　-‐‐- 、
／　　　　　ヽ
!　 !　人|,.iﾉl_ﾉ） Freshen your cup, comrade?
i 　乂-‐　－! i
＼ヽ .ゞ　- ﾉノ
　　｀｀フ　i´
　 　 / ＼ﾉゝ
　　/__i |★!|
━━つ━つ━━∞∞∞========
==　　 ☭THE CHE\'S DINER☭　 ==
∞∞∞∞∞∞∞∞∞∞∞∞∞∞', '　　　-‐‐- 、
／　　　　　ヽ
!　 !　人|,.iﾉl_ﾉ） You guys are disturbing the other customers.
i 　乂-‐　－! i
＼ヽ .ゞ　- ﾉノ
　　｀｀フ　i´
　 　 / ＼ﾉゝ
　　/__i |丱!|
━━つ━つ━━∞∞∞========
==　　 THE REI\'S DINER　　 　==
∞∞∞∞∞∞∞∞∞∞∞∞∞∞', '　　　-‐‐- 、
／　　　　　ヽ
!　 !　人|,.iﾉl_ﾉ） Sorry, We\'re All Out Of Properly Capitalized Sentences.
i 　乂-‐　－! i
＼ヽ .ゞ　- ﾉノ
　　｀｀フ　i´
　 　 / ＼ﾉゝ
　　/__i |丱!|
━━つ━つ━━∞∞∞========
==　　 THE REI\'S DINER　　 　==
∞∞∞∞∞∞∞∞∞∞∞∞∞∞', '　　○
　　∥
┌-─────┐
｜　　□　□　　 ｜I AM ELECTRONIC SWASTIKA SHITTING MACHINE.
｜　　　　　　　 　│
｜　　　△　　　　│
｜　 　ロボツ　　│ 卍卍卍卍
━━凹━━凹━∞∞∞======
==　　DESERT ISLAND　 　 ==
∞∞∞∞∞∞∞∞∞∞∞∞∞
卍卍 卍卍 卍 卍卍卍卍 卍 卍 卍卍 卍', 'I don\'t want your money, I only want your love.
　　　　　　　　　　　　　　　　　　　,...　 --‐‐―‐-｀ヽ/_＿__
　　　　　　　　　　　　　　　　　 ／:::::::::::::::::::::::::::::::::::::::::::::::::::::｀ヽ、
　　　　　　　　　　　　　　　　／::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::＼
　　　　　　　　　　　　　　　/:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::ヽ
　　　　　　　　　　　　　　/::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::l
　　　　　　　　　　　　 ／/::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::l
　　　　　　　　　　　　　 ﾉ::::::::::::::::::::::::::::::::::::::／|::::::／|ハ::::::::::::::::::::::::::::::|
　　　　　　　　　　　　　 ｽﾍ:::::::::::, 1　/!/|／\' 　レ\'　　 　 ＼!i .人:::::::::::::|
　　　　　　　　　　　　　ゝ::::::::::／　ﾚ\'　　　　　　　　　　　　　|ﾉ　|:::::::::::ﾉ
　　　　　　　　　　　　　 ＼:::::::|　　,　　　 　　 l　　i　　　　　　l ﾉ:::::::::/
　　　　　　 　 　 　 　 　 　,ヽ:::|　/＿___＿__　ヾ　ﾉ　＿＿_＿ヽ1_=/
　　　　　　　　　　　　　 　{ ヾヽ. \'　., -‐rｯ‐-｀ヽ!　ゞ=-‐ｔｯ=- ､｀|f,ﾄ 〉
　　　　　　__ .,-u--、　 　l （＼lー（　｀ｰ--‐´ ﾞｒ―.〈 ｀ﾞー-- \' ﾉ7/| l
　　　　　 / |｀ー／ ヽ　　 ＼ヾ｜　ゝ.、＿__ ノ　　　ヽ ＿ ／ｌ:!h /
　　　　／ ¨｀ヽヾ ／ヽ　　　 ヽﾄ　　　　　　　　　　　　　　　 |:| /
　　　　! .´　ヾll | | |　　|　　　 　 |ﾄ　　　　　/、　　ヽ　　　 / .l::|´
　　 　 |.ゝ　ノ /|/ .L／|　　 　　 |i ヽ　　　\'　 ｀ー´　｀　　/　//
　　　　ヽ ー ´/ ｆ　l ゞfi-, = ､ へヾ.　　　　 -―――-　 　 /:/
　　　 ＿|　 　|　! |」__　/　　　ヽ　｀ﾞ＼　　　 　―　 　 　／:/ヽ
　 　/　 .ゝ___ﾉﾉ/__　| ゝ___ ,ｨ/　　　　¨ﾞ｀ヾ／｀´^ヾ／ ／ |　/
　 ./　 /　　|　　||､ｌ_｜　!ﾞ¨~/　＼　　　　　　＼:::::::::::／　￣ く ヽ、
　/　 /ヽ.　 ! 　 |!　ヽ! 　|ゝ 〉　　　ヽ＿　　　　　/-ｰ\' : : : : : : /　　|
｜ 　l　　＼|　　|!ノ, - 、 /　　ヾ　　＼　　 /: : : : : : : : : : ヽ　　＼
｜　/}ヽ..　 L＿|／　 　ﾉ|\'　　　　　丶　　＼/ : : : : : : : : : : : | 　 　 ＼
/　/ ｛　 ＼　　　 　　／ !ｌ 　 　 　 　　 　 　 //＼＿:: : : : : : : >1　 　　＼_
|　 ヽ |　　　ヽ-ー ￣　 ﾉ.|　　　　　　　　　 //　　　 /: : : : ／／ !　　　 　　＼
|　　ヾ|　-､　　 　 　_ ／>|　　　　　　　 　 //　　　 / : : : : ＼＼｜　　 　　　　＼
＼　　＼　｀ﾞ ー‐ ´　 ／/　　　　　　 　　//　　　 / : : : : : : : ＼ .|　　　　　　　　丶
　ヽ　　| |｀ﾞ―---―\' //　　　　　　　　　//　　　 /: : : : : : : : : : :ヽ!', '　　　　　　　　　　　_,,,,,--―--ｘ，
　 　 　 　 　 ,,,,-‐\'"゛_,,,,,,,,,、　　 .ﾞli､
　　　　 _,-\'"゛,,―\'\'ﾞ二,､､、ﾞ\'!　　 .ｉ㍉
　　 .,／｀,,／,,,,ｯﾒ\'\'＞.,,／,-゜　,,‐｀ │
　_／　,‐ﾞ,／.ﾍrﾆﾆ‐\'ﾞン\'′,,／　　　 |
,,i´　　|、 ﾞ\'\'\'\'\'\'ﾞﾞ_,,,-‐\'" _,,-\'"　　　　 .lﾞ
.|,　　　`^\'\'\'"ﾞﾞ｀ ._,,,-\'\'\'″　　　　　　,lﾞ
｀≒------‐\'\'"゛　　　　　　　　　 丿
　 ＼　　　　　　　　　　　　　　 ,,i´
　　 ｀ヽ、　　　　 　 　 　 　 ,,／
　　　　 `\'\'-､,,,_.∩　 _,,,,,-∩´
　　　　　　　　//ﾞﾞﾞﾞ″ 　 | |
　　　　　　　 //Λ＿Λ　 | |
　　　　　　 　| |（　・Д・）// ＜ Deep Fried in beef tallow!
　　　　　 　　＼　　　 　 |', '　　 　 　 　 　 　 　 　 ,. :´:..:..:..:..:..:,:;\':::..:..:..｀:..､
　　 　 　 　 　 　 　 ／.:／.:../...l.:..:.ゝ:.ヽ.:..ヽ.:.::ヽ
　　　　　　　　　　 /.:. ,\':..:..:./..:..:::.:..::..:..:..:..:..:..:..:.::::\',
　　　　　　　　　　,\':..:..:.::.::.:ﾊ::..:..::l､::.､::.ヽ:..:..:..:.:.::::::;
　　　　　　　　 　 l.::..:..:::.:ﾄ:!´V､:.:l´ゝ､ヾ｀;:..:..:.::.::::::i
　　　　　　　　　　\';:､.::.::{､r\'ﾆヾ ｀ゝ´iJ:ヾ, }:.::,\'::.::::::l
　　　　　　　　　　 ｀ヽ:.::「\'､じ′　　 じｿ｀/.:/:::::::;:;\'
　　　　　　　 　 　 　 {;､::| , , ,. \'､　　\' \' \'ノ,:ノ.:::::/ﾉ　　We ARE those anime people, you half-wit.
　　　　　　　　　　 　 ﾚl.::ゝ 　 ｰ -‐\'　／.:::::;／
　　　　　　　　　　　　　ヾ:jヾ! ‐,　_. - ´|:/´
　　　　　　　　　　　　　　　　　ﾉ＼／ ´ゝ.._
　　　　　　　　　　　　,. -r─f´j ／|!　　 ﾉ､/￣｀7‐- ､
　　　　　　　　　　　/　 //　{-|//「|ヽ　/ :/　 「 {　　　ヽ
　　　 　 　 　 　 　 ﾊ　//　 .! l\'/l |ﾉ\' ∨ ,/　　| |　　　ヽ \',
　　　　　　　 　 　 |　V {::　　V/´l| ／ ／　　 | |　　　　\', |
　　　　　　　　 　 /　 ﾄ/.:.　 〈/´Vl!,／　　　　| | ./　　　Y
　　　　　　 　 　 /　　|′　 　 ＼／　　　.::.. .::| V　 　 　 \',
　 　 　 　 　 　 /　　 {　　　　　　 　 　 　 ::;::::::l :!　　　　　\',
　 　 　 　 　 　 ＼ 　 !.::::::...　　 　 ....::::::::.... ﾞ;::::ヾ　　　 ＿_」
　　　　　　　 　 　 ｀r‐!:::::::::::::::::::..　.:.::::::::::::::::.`:ｰ|-‐ ７-‐´', '　　　 ／　 　 　 　 　 　 　 　 !　l　ヽ　 |　　　　　　　＼
　　 /　　　　 　 　 　 ｉ　　　 ,\'ｌ　|　　 \',　|　　　　i　 　 　 ,
　 /　　　　 　 ｉ　　　 l　 　 /｜ !　　　l　ｌヽ　 　 l　 　 　 \'
　,\'　　　 　 　 l　　　ｌ |　 _/　 ! ,\'　 　 .⊥.Ｌ_\',　　 ｌ　｜　　i
. ′　　　　　 |　 _,./ ｧ\'´/　　!/　　　　！l　｀iｰlｉ､l 　 ! 　 ｜
. ! 　 ｜　　　\'´ 〃,\'　/　　/　　　　　　!|　　l: | !|i　｜　 . !
｜　　l　　　´!　.///／ __　　　　　　　　二..__ !|　! !　! 　 l | 　　
！　　ｌ　　　｜/〃\'z=_＝=　　 　 　 　 ´, :￢:､ヽ !｜l　　 l,! 　　　
　!　　 ! 　 　 |\' ／/´..:.:.ヽ 　 　 　 　 　 i:.:tｯ:.:.i　ヽ !:!　　 | 　　　　　　　
　 !　　l　　　 l/　 {:.:.ゞ\':.: }　　　 　 　 　 t ｰ-;ﾉ 　 ｉ{ﾘ　　 |
.　 l　 ,\'|　　　,l　　ヽこ..ク　　　　　　　 　 ｀¨　　 　 |　　　|
.　　!. { l 　 　 |　　　　　　　　　　　 ,　　　　　 　 　 ｌ　 　 !
.　　 ! ｀| 　 　 |　　　//////　　　　　　////// 　 ,　 　 l 　WHATTo?　
　　　i.　l 　 　 |　　　　　　　　　　　　　　　　　 　 /　 　 !
　　　 !　l　　:　l＼　　　　　　　 r－‐,　　　　　 ／　　　 !
　　　｜! ｌ　 : . l: !: 丶､　　　　　｀　　　　 　 イ : |　:　　,′
.　　　 |j　.l　 : . l: !:､: : : ｀:i ー-　.__　 -‐1´: l:| : l　: 　 ,{　　　　　_＿
.　　　 ,\'　: :!　: :. l:ヽヽ ___: }　　　　　　　 ヽ: :!: : ! : ;′ハ　　　〃⌒ヽヽ
　　　/　: :l :!　:!: .i-ｧ\'´, \'´！　　　　　　 　 ｀ｰ / :./　,′.ヽ　　l! 　 　 } }
　　 /　. :,{: :ﾍ .ﾄ､:ヽ,.ｲ　　.\'　　　　　　　　　　/ :〃 /､: . ヽ＼　　　 ノノ', '　. 　/￣|　　／|　 /￣|　　/￣| ＼ ／　/￣/　/￣/　/￣/　/
　　/　　.|　/＿/ /　　.|　/　　.|　 /　　/　　　/　 /　/　 /　/
　 /＿／／　/　/＿／ /＿／　/　　/＿/　/＿/　/＿/　/＿＿

　　　　　　　　　　　　　　　　　　　　　　　　　/＼＿＿_／ヽ
　　　　〃ﾆ;;::`lヽ,,_　　　　　　　　　　　≡　 ／\'\'\'\'\'\'　　　\'\'\'\'\'\':::::::＼　
　　 　〈 (lll!! ﾃ-;;;;ﾞfn　　　　__,,--､_　　..　 . |（●）,　　　､（●）､.:|　＋　≡
　　　／ヽ-〃;;;;;;;llllll7,,__／"　　＼三=ー　|　　 ,,ﾉ(､_, )ヽ､,,　.::::|　　 　　≡ 　
　　　>､/:::/＜;;;lllメ　　　＼ヾ、　　ヽTf=ヽ`　　 ｀-=ﾆ=- \'　.:::::::|　+
　　j,,　ヾて）r=- | ヾ:　　 :ヽ;;: 　　　 | l |　 l ＼　　｀ﾆﾆ´　 .:::::／　　　　　+　　≡
,ｲ　ヽ二)l(_,＞"　l|　　　 ::＼;:: 　　　| |　 |　　ヽ,,-‐、i\'　　／ V
　i、ヽ--ｲll"/　,, ,//,,　　　　:;;　　　l //　 l く> /::l"\'i::lll1-=::::￣＼
　ヾ＝=:"::^::;;:::／;;;;;;;;;:::::::::::::: :::::ゞ ﾉ/　　 L／〈:::t_ｲ::/ll|─-=＝　ヾ
　　＼__::::::::／::::::::::::＿;;;;;;;;;;;;;;;;;ノノ　　　ﾍ　　　>(ﾞ ）l:::l-┴ヾ、ヽ　 ）
　　　　 ￣~~￣￣／　:::|T==--:::::　 ／／　　/　ﾄ=-|:|-─ （ l　　 /
　　　　　　　　 ／　::　 ::l l::::::::::::::::::/ /:::::::::::/:::::(ヽ--─　 /　|　 /
　　　　　　　　 ヽ＿=--"⌒￣ﾞﾞヾ:/ /:::::::／:::::::::`<==--　ﾉ　/　/
　　　　　　　　　／　　　／　　　＼/:::::::::::::::::::::::::::::￣\'\'\'""::／／
　　　　　　　 ／　　　／　　　　 :::: ヾ::::::::::::::::::::::::::::べ__;;;--" ', '　　 　 　　　　　　 , \'´ ￣￣ ` ､
　　　　　　　　　　i　r-ｰ-┬-‐､i
　 　 　　　　　　　|　|,,＿ 　 ＿,{|
　　　　　　　　　　Ｎ| "ﾟ\'`　{"ﾟ｀lﾘ　　　　　や　ら　な　い　か
　　　　 　 　 　 　 ﾄ.i 　 ,__\'\'_　 !
　　　　 　 　　　／i/ l＼ ー .ｲ|､
　　　　,.､-　￣/ 　|　ｌ　 ￣ / |　|` ┬-､
　 　 /　 ヽ.　/ 　 　ト-` ､ノ- |　 l　　l　 ヽ.
　　/　　　 ∨ 　 　　l 　　|!　 | 　 ｀>　|　　i
　 /　　　　 |｀二^>　 ｌ.　　|　 |　＜＿_,|　　|
＿|　 　　　 |.|-<　　　 ＼ i　/　,イ_＿__!／ ＼
　 .|　　　　　{.|　 ` - ､ ,.---ｧ^!　| 　　 |￣￣￣￣￣￣￣￣￣￣￣l
＿_{ 　　＿__|└―ｰ／　￣´ |ヽ |＿__ﾉ＿＿＿＿＿＿＿＿＿＿＿_|
　　｝／ -=　ヽ__ - \'ヽ 　 -‐　,r\'ﾞ　　　l　　　　　　　　　　　　　　　　　 |
＿_fﾞ/／￣￣　　　　　＿　-\'　　　　 |＿＿＿＿＿ ,. - ￣　＼＿＿__|
　　| |　　- ￣　　　／　　　| 　 　 _　|￣￣￣￣ ／　　　　　　 ＼　￣|
＿__`＼ ＿＿　／　　　　＿l -￣　 l＿＿_　／　　　, /　　　 　ヽi＿__.|
￣￣￣　　　 |　　　 _ 二 =〒 ￣　 ｝￣ ／　　　　　l |　　　　　　!￣￣|
＿＿＿＿＿__l　　　　　　 -ヾ￣　　l／　　 　 　　 　l|　　 　　　 |＿＿_|', '　　　　 (∩),,,,,,,,,(∩)
　　　 ノ　　　　　　　ヽ　　　　　What you say?
　　/⌒)　 ●　　●　ミ 　　　　　　　　　　　　Ten year owd?
　 /　/( 　 (＿●__)　 》　　　　　　I am interested. Prease show me goods for sayre.
　(　　彡;;;; 　|∪/　 ;ﾐﾐﾐ', '　 _ 　∩
(　ﾟ ヮﾟ)彡 Individualism!
　⊂彡 Individualism!', '　　　　＿＿＿＿_
　　 ／::::::::::::::::::::::::::＼
　 /::::::::::::::::::::::::::::::::::::::＼
　 |:::::::::::::::::|＿|＿|＿|＿|
　 |;;;;;;;;;;ノ　　　＼,, ,,／ ヽ
　 |::（ 6　　ー─◎─◎　）
　 |ノ　　（∵∴　（ o o）∴）　　My butt\'s still really slick from the last meal I had here!
／|　　　<　　∵　　 ３　∵>
::::::＼　　ヽ　　　　　　　 ノ＼
:::::::::::::＼＿＿＿＿＿ノ:::::::::::＼', '　　　　　　　　　　　　　 _,　-‐--....､
　　　　　　　　　　　／..:::::::::::::::::::::::::::.ヽ
　 　 　 　 　 　 　 / .:.::::::::::::::::::::::::::::::::::::.ヽ
　　　　　　　　 　/..:.:.:.:.::::/:::;i:::::,|:::::l:::::;::::::.ヽ
　　　　　　　　　 l::::::l::::::/l::/ |::/{::/|::;/l::}:;::;::i
　　　　　　　　　 l/i::l:::N`|ﾒ､_|ﾑ|/.,j／ﾚ|::|::ト!
　　　　　　　　　　f＾i:::ｌ　\'\'ZＴｰ 　 ｨ\'Zト.|::|::ﾚ\'＾ヽ､
　　　　　,...-\',,⌒ゞﾐ､l::|.　　　 　　ｌ　　　l::!Y::::::::::::::.ヽ､　　　
　　　　/::／..::::::::::::..ヽl_　　　 　　〉 　 /ｖ\':::::::::::ﾉ::_;;:::::j,ト､
　　　/:::::::::::::::::::..`ｰ-､:l､ 　f＝==r 　,ﾍ:::::;::::::/￣　ﾞ\'\'ﾍｭ_ﾉ　OH SNAP!
　　 /:::::::::::::::::::::::::::::::;;_ヾ;:､L＿,,ﾘ ／:>:l/:::／
　 ./:::i|:::::::::::::::::::::::::::::::..｀\'\'ヾ､ｰ-イ, 〉<.|／　ノ⌒ ｰ - ,,,＿＿　　＿
　 }:::::::l::::::::::::::::::::::::::::::::::::::::::::::..ﾞヾ!､!;::|:|,r‐\'ﾞ　　　　　　　　 　 ／/ 　 ヽ
　「::::ヾ|:::::::::::::::::::::::::::::::::::::::::::::::::::::::::;ヽf　　　　 ヽ　　　 　 　 l /　　　 l
../::::::::::l::::::::::::::::::::::::::::::::::::::::::::,,-\'\'\',ﾆ,-\'"　　　　　　＼___　　　　　　 　/
/:::::::::::..ヽ;::i:::::::::::::::::::::::::::::::::/ .／　l　　　　　　　　　 ＼X=-､,,＿_／
:::::::::::::::::..ヽl;:::::::::::::::::::::::::::::::|　|　　ﾉ　　　　 ` ､ 　　　　 ヽ ,ﾍ./
:::::::::::::::::::::..ヽ､:::::::::::::::::::::::::::|　l　i´　　　　　　　` ､　　　 ﾉ ヾ|
:::::::::::::::::::::::::::..｀ヽ;::::::::::::::::::::|　|　|　　　　､　　　　　`\'rイ　 ,ノ
::::::::::::::::::::::::::::::::.::..＼∩:::::::::|　l＼ 　　　　 `=､.._＿,ノ　 ￣
:::::::::::::::::::::::::::::::::l::::::::i＼∩:/　 |　ヽ､＿　　　　ﾉ
::::::::::::::::::::::::::::::::|::::::::|　 ＼:!`ｰ､ 　,,=\'\'::::｀､\'‐-\'ﾞ
:::::::::::::::::::::::::::::::::l::::::::l　 ｌ　ヽ_;;ｧ\'~ヽ;::::::::::.ヽ
::::::::::::::::::::::::::::::::::|::::::::|　 |　i　　　　ヽ;::::::::::..＼', '　　　　　　　 /,. -‐\'⌒￣⌒ｰ-､　＼　　　 ＼
　　 　 　 　 /\':.:.:.:.:.:.:.:.:.:.:|.:.:.:.:.:.:.:＼　ヽ:　/_／
　　　　 　 /.:.:.:.:.:/:.:.:.:,:.:.:|:.:.:ヽ.:.:.:.:.:.\',　} /:.:.|
　　　　　 l{:.:.:.:|:.l:.:.:.:/l/\'ハ:､.:.:ヽ.:.:.:.:} .{::.:.:.:.:l
　　　　　 ﾊ:.:.:.|:|:.／/ ノ ‐ヾ＼_|l.:.:.:i　}::.:.:.:.:.\',
　　　　　　 ヽ:.:.{. ,:=､　　 =＝､ ﾉ.;./ /::.::.::.:.:.:.\',
　　　　　　　　ヽゝ　 ､　　　　　ｿ!※}::.::.::.::.:.:.
　　　　　　　　　{ ｀ヽ、ヽﾌ　／ｲ　 /‐､_:.:.:.:.:.:.
　　f＾)＾)＾)＾)＾)＾)＾)＾)＾)＾)「-､_,{※}　ｒ′ヽ:.:.:.:.
　ｒ\'\'⊇、　　　　　　　　　ｌ|ヽ_/　 } t′　　\',:.:.:.
　{　==\'､　　　NEEDS　　ｌ|!;r\'!※{ ｔ′　　　\',:.:.:
　ﾊ,,_う　　　　　MORE　l||;;l}.　 {,ｺ 　 　　　!:.
_{\'V|ｌ　　　DESU～U!　 ｌ||;;;{※.},ｺ　　　　　 !、
ゞ　|l　　　　　　　　　　　ｌ|.l;;{　　},ｺ　　　　　　}
＼,,|ｌ　　　　　　　　　　 l| L{.※{,ｺ　　　　　 /|
　　|ｌ＿＿＿＿＿_＿＿l|,rn}　 },ｺ＼　　 ／　〉', '　　　-‐‐- 、
／　　　　　ヽ
!　 !　人|,.iﾉl_ﾉ）　　
i 　乂-‐　－! i
＼ヽ .ゞ )- ﾉノ munch munch I\'m sorry, you\'re all out of fries.
　　｀｀フ　i´　
　 　 / ＼ﾉゝ
　　/__i |丱!|
━━つ━つ━━∞∞∞========
==　　 THE REI\'S DINER　　 　==
∞∞∞∞∞∞∞∞∞∞∞∞∞∞', '　　　-‐‐- 、+　　　　。　　　　　+　　　　。　　　　　＊　 　　
／　　　　　ヽ　　　。　　　　　　　　　　 　　　。
!　 !　人|,.iﾉl_ﾉ）　 　＊　　+　　　　。　　+　　　　+　　　。　+
i 　乂-‐　－! i 　 The salt started flying around in the store for some reason.　　＊　　　+
＼ヽ .ゞ　- ﾉノ　　。　　+　　　　　＊　　+　　　　。　。
　　｀｀フ　i´。　　　　＊　　　　　。　　　 　　　 。　　　　　　
　 　 / ＼ﾉゝ　　　　+　　　　。　　　　　＊　　　　+　　　　。　　
　　/__i |丱!|　　。　　　　　+　　　　。＊　　+　　　　。
━━つ━つ━━∞∞∞========
==　　 THE REI\'S DINOR　　 　==
∞∞∞∞∞∞∞∞∞∞∞∞∞∞', '　　 ∧__∧　 ∩ I\'m not some lame general practitioner, I won the Nobel prize for Medicine back in 1993!
　　（,,´ω`)彡☆　
　　　⊂彡☆))∀・) Ouch, ow, sorreee, ouch!
　　　　☆', '　　 ∧＿/へ-ﾍ
　　（　・∀ﾐ*´ｰ｀ﾐ
　　（　つ と　　0
　 　 ）　 ⊂ _,ノ～
　　（＿_）＿）　

　　 ∧＿∧　　munch munch
　　（　・)-・）.,..,,
　　（　つ と　　0
　 　 ）　 ⊂ _,ノ\
　　（＿_）＿）　', '　　　-‐‐- 、
／　　　　　ヽ
!　 !　人|,.iﾉl_ﾉ）　　
i 　乂-‐　－! i 　Sorry, I was mistaken. We don\'t actually have
＼ヽ .ゞ )- ﾉノ 　any more. Freshen your cup?
　　｀｀フ　i´　 　　　
　 　 / ＼ﾉゝ　 　　
　　/__i |丱!|　 　 　
━━つ━つ━━∞∞∞========
==　　 HI, SERENE DIRT　　 　==
∞∞∞∞∞∞∞∞∞∞∞∞∞∞', '
　　　　　　　　 |.|　　　　　　　　　　　　　　　　　　　　 ／/
　　　　　　　　 !|　　　　　　,...------､,,,　　　 　 ／　/
　　　　　　　　 .|　 ,. -‐\'\' ´　　　　　　　　　｀｀`､／　 /
　　　　　　　　　>\'ﾞ　　　　　　　　　　　　　　　　　　　￣￣｀ ヽ ､
　　　　　　　 ／　　　　　　　　　　　　　　　,　　　　　　　　､　＿_｀`ヽ､
　　　　　 　 /　　　　　　　　　　　　　　/ｉ　|､r､ｨｉｉ.|　,　　　　ヽ　　￣\'\'\'\'\'`ヽ
　　　　　　./　　　　 　 |　　　　 　　　./ | .|　　　　| .|　　 　　 ヽ,
　　　　　　f　　　　　　|　　　　　　　 /　 | |　　　　 | |　　,　　　　\'､
　　　　　 .|　　　　　　|　　　 　 | 　../　　.||　　　　 | ﾊ 　.|　　　　 ヽ
　　　　　 .|　　　　　　|　　　　 | 　./　　　 |　　　　 |\'　|　 |　 ト､　　ヽ
　　　　　　|／　　　　|　　　　 .|　/　　　　｀　　　　\'　 ﾊ　|　 .|　ヽ, 　 ｉ
　　　　 ／　　　／　 |　　 　 /| /　　　　　　　　　　 /　|.|　　|　　｀ヽ, |　　
　　　 / _,,.ｨ／　　　　|　　　/ .ﾚ　 　 ＼　　　 ／　 / ミ|ﾊ　 .|　　　　ヽ
　　 /／／　 　　./⌒|　　 / ,,,,,,,,,,,,＿,,,　　　　 ---i\'）　｀`\',　.|
　　´／／　　　　|　　.|　 /.　　､,＿__, ’　　　　 =＝|　弋-ﾍ.
　. /／/ 　　　　 弋＿| ./　　　　ヾ彡.　　　　　　 ,.ﾉ　　ヽ, Can\'t you see Sebastian
　　　./　　　／　_,.ィ＜|.へｨ‐‐､　　　　　　__,｡ィ\'ﾞ　　　 　 |  　sells sea shells on
　　 /　　／,,ィ\'ﾞ√,＼〉／　　　ヾ\'\'\'ｧ‐--‐\'ﾞ､　ヽ,ﾞﾞ\'\'‐　,,　　| 　the sea shore these days?
　　/　／‐\'ﾞ　　/　　ﾞＶ　　　　 ﾉノ　 ｀ｉ　　　〉､＼ｉ　　｀`ヽ､,,|
　　レ\'　　　　. {　　　.|　　 .r‐\'ﾞ\'´ヽ　　|　　./:/.)､ 　　　　　
　　　　　　　　|　　　.|　　　|＼､＼\'､　|　 / / /.ｨ\'
　　　　　　　r┴---┤　　 |λヽ､ヽｉ .レ\'ﾞ/../-\'ﾞ ﾍ､__
　　　　　 　 |　_,,,,,,,,,,,|　　　|　｀ｉヽヽ::ｉレ\'ﾞ／ﾉ　 ／ .　>
━━━━━━━━━━━━━━━━━━━━━━━━━━━━∞∞∞========
==================　 The Lucky Channel Idol Free Advice & Sage Opinions Desk　 ==============
∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞　∞∞∞∞∞∞∞∞∞∞∞∞∞∞', '
　　　　　　　　　　　　　　　　　　　　　　 ◯　　　　　　　　　　　　　　　 　　＿＿_＿＿
　　　　　　　　　　　　　　　　　　　　　　//　　　　　　　　　 　＿＿＿＿／　　　　　　　＼_____＿＿__
　　　　　　　　　　　　　　　　　　　　　 // |＼＿＿＿＿＿／　　　　　　　　　　　　　　　　　　　　 ／
　　　　　　　　　　　　　　　　　　　　　// │　　　　　　　　　　　　　　　　　　　　　　　　　　　　 　/
　　　　　　　　　　　　　　　　　　　　 //　│　　　　　　　　　　　＿＿＿＿　　　　　　　　　　　　（
　　　　　　　　　　　　　　　　　　　　//　 │　　　　　　　　　 ／∵∴∵∴＼　 　　　　　　　　　 ）
　　　　　　　　　　　　　　　　　　　 //　　│　　　　　　 　　/∵∴∵∴∵∴＼　　 　　　　　　　/
　　　　　　　　　　　　　　　　　　　//　　　|　　　　　　　　 /∵∴∴,（･）（･）∴| 　　　　　　　　/
　　　　　　　　　　　　　　　　　　 //　　　/　　　　　 　　　|∵∵／　　 ○　＼|　　　 　　　 ／
　　　　　　　　　　　　　　　　　　//　　　/　　 　 　　　 　 |∵ /　　三　|　三　|　　　　　　 |
　　　　　　　　　　　　　　　　　 //　　　/　　　　　　　 　　|∵ |　　　＿_|＿_ 　|　　　　　　 /
　　　　　　　　　　　　　　　　　//　　　/　　　　　　　　　　 ＼|　　　＼＿/　／　　　　　　｜
　　　　　　　　　　　　　　　　 //　　／　　　　　　　　　　　　　＼＿＿＿_／　 　　　　　　/
　　　　　　　　　　　　　　　　//　／　　　　　　　　　　　　　　Marty\'s！　　　　　　　　　（
　　　　　　　　　　　　　　　 //＜　　　　　　　　　　　　　　　　　　　　　　　　＿＿＿＿＿＼
　　　　　　　　　　　　　 　 //　　＼＿＿　　　　　　　　　　　　＿＿＿___／　　　　　　　 ￣
　　　　　　　　　　　 　 　 //　　　　　　　＼＿＿___＿＿＿／ 　　　　　　　　　　　　　
　　 　 　 　 　 　 　 　　 //
　　　　　　　　　　　　　//　
　　　　　　　　　　　　 // 　
　　　　　　　　　　　　//　　　　　　　　
　　　　　　　　　　　 //　　　　　　　　　　　　　　　
　　　　　　　　　　　// 　　　　　　 　 　 　 　 　
＿＿＿＿＿＿＿ // ＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿', '　　＿＿＿＿＿＿＿＿＿＿_
　　|　김치　　　|　갈비　　 　|
　　|　김밥　　　|　비빔밥　　|　
　　|　잡채　　　|　라면　　 　|
　　 ∧＿∧　　 |＿＿＿＿＿|
　　<ヽ｀∀´>　＜ We serving kim chee. It more healthful than water nida!
　　（　　　　）　
━━つ━つ━━∞∞∞========
==　　 THE NIDA\'S DINER　　 　==
∞∞∞∞∞∞∞∞∞∞∞∞∞∞', '━━━━━━━━━━━━━━━━━━━━━━━━━━━
　CAUTION!!　　　CAUTION!!　　　CAUTION!!　　　CAUTION!!　　
━━━━━━━━━━━━━━━━━━━━━━━━━━━
　 ▲　　▲. 　　　　　.▲　　▲. 　　　　　▲　　▲. 　　　　　▲　　▲. 　　　　
.　　　●　　　　　.　　　　●　　　　　.　　　　●　　　　　.　　　　●　　　　　
.　　　▲　　　　　　　　　.▲　　　　　　　　　.▲　　　　　　　　　.▲　　　　　
━━━━━━━━━━━━━━━━━━━━━━━━━━━
　CAUTION!!　　　CAUTION!!　　　CAUTION!!　　　CAUTION!!　　　
━━━━━━━━━━━━━━━━━━━━━━━━━━━
　Ｏ　。　　　　　　　　　　　 ,　\'"　　}
　　　ト ､.,＿　　　　　 　 ／　　　　 {
　　　ヽ.　　　＼ _,._-=ﾆ´=─‐-＜ くｰ-‐ｧ　　　　 　 　ﾄ.、　　　　
　ｵﾛ 　}_＿,＞\'\'"´::::::::::::::::::::::::::::::::｀ヽ,　/　　 　 )　 　 .!::::＼∧
　,..-‐　ﾉ／::::::::::::::::;:::::::::;:::::::::｀ヽ;:::::::::∨　　-‐\'\'　　　　|:::::::::::::::＼
.(　　∠.7::/:::::::::/:::ハ::::;ﾊ､::::::::::::::\':;::::::::\',　 ＿ノ　 　　 !:::::::::::::::::::::\':,＿
　　　　/:::!::::::::/:::/　 ∨　ｰ-＼::::::::＼::::|　　　　ｵﾛ　 ,\'::::::::::::::::::::::::::::/_
　　 ∠＿:\';:::::/イ　 　 　　 ●　｀\'7ｧｰrヽ!　 　　　 　 /:::::::::::::::::::::::::::::／
ﾟ　　　　/:::∨::! ●　　　　　　 "" |::::::|:::::\'、　ｏ　　, ｲ:::::::::::::::::::::::::::::/
　　　／:::::/:::7\'\'"　　 ｒ‐- ､　　　 ,\':::::/::::::::＼　 ／　\',::::::::::::::::::::::::::,\'
＼ \'´￣｀7::::人　　 　 ､___ﾉ ι ,.\'::::;:\':::::::::::::::::∨　　　ヽ::::::::::::::::::::::i
::::::ト､　　|／/::|＞ ､.,,＿_ 　 イ|／､_::::::::/!:::::/　　　 　 !:::::::::::::::::::,\'
::::::|　 ＼ ／:::/::::::::_;r＜|___／　　//´￣｀ヽ/　　　　　 |::::::::::::::::/
━━━━━━━━━━━━━━━━━━━━━━━━━━━
　CAUTION!!　　　CAUTION!!　　　CAUTION!!　　　CAUTION!!　　
━━━━━━━━━━━━━━━━━━━━━━━━━━━
　 ▲　　▲. 　　　　　.▲　　▲. 　　　　　▲　　▲. 　　　　　▲　　▲. 　　　　
.　　　●　　　　　.　　　　●　　　　　.　　　　●　　　　　.　　　　●　　　　　
.　　　▲　　　　　　　　　.▲　　　　　　　　　.▲　　　　　　　　　.▲　　　　　
━━━━━━━━━━━━━━━━━━━━━━━━━━━
　CAUTION!!　　　CAUTION!!　　　CAUTION!!　　　CAUTION!!　　　
━━━━━━━━━━━━━━━━━━━━━━━━━━━');
	return $messages[array_rand($messages, 1)];
}