<?php

trait UsefullMethods
{
	public function alertMessage($message, $text, $color)
	{
		$_SESSION[$message] = "
			<span style='color: {$color};'>{$text}</span>
		";

		return $_SESSION[$message];
	}
}