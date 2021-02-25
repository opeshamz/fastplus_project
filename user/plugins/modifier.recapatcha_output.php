<?php
function smarty_modifier_recapatcha_output($pubkey) {
$capatcha = "<script>var RecaptchaOptions = {theme: 'custom', custom_theme_widget: 'recaptcha_widget'};</script>";
	$capatcha .= '<script type="text/javascript" src="http://www.google.com/recaptcha/api/challenge?k=' . $pubkey . '"></script><noscript>
        <iframe src="http://www.google.com/recaptcha/api/noscript?k=' . $pubkey  . '" height="300" width="500" frameborder="0"></iframe><br/>
        <textarea name="recaptcha_challenge_field" id="recaptcha_challenge_field" rows="3" cols="40"></textarea>
        <input type="hidden" name="recaptcha_response_field" value="manual_challenge"/>
    </noscript>';
	$capatcha .= '<div class="row">
					
					<div class="col-md-6 margin-bottom-20">
						<div class="input-group">
                              <input type="text" id="recaptcha_response_field" name="recaptcha_response_field" class="form-control" required />
                              <a class="btn btn-default input-group-addon" href="javascript:Recaptcha.reload()"><span class="fa fa-refresh"></span></a>
                              <a class="btn btn-default input-group-addon recaptcha_only_if_image" href="javascript:Recaptcha.switch_type(\'audio\')"><span class="fa fa-volume-up"></span></a>
                              <a class="btn btn-default input-group-addon recaptcha_only_if_audio" href="javascript:Recaptcha.switch_type(\'image\')"><span class="fa fa-picture-o"></span></a>
						</div>
					</div>
					<div class="col-md-6 margin-bottom-20">
                      <div id="recaptcha_image"></div>
                    </div>
				</div>';
	
	return $capatcha;
}
?>
