<?php

trait UsefullMethods
{
    public function alertMessage($messageName, $text, $bg, $color="text-dark", $delay) // toastAutoHide ni ham sinab ko'rish kerak, autohide yo'q bo'lsa delay ishlaydimi yo'qmi shuni aniqlash kerak.
    {
        $_SESSION[$messageName] =
            '
                <div class="notifications">
                    <div id="toastAutoHide" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="'.$delay.'">
                        <div class="toast-header '.$bg.' '.$color.'">
                            <strong class="mr-auto"><span class="ion-ios-notifications"></span></strong>
                            <small>'.date('H:i').'</small>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                <span aria-hidden="true" class="'.$color.'">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            '.$text.'
                        </div>
                    </div>
                </div>
            ';
        return $_SESSION[$messageName];
    }

    public function goHome()
    {
        header("Location: /");
    }

    public function goBack()
    {
        return "<script>window.history.back();</script>";
    }

    public function Refresh()
    {
        $page = $_SERVER['PHP_SELF'];
        $sec = 0;
        header("Refresh: {$sec}; url={$page}");
    }
}