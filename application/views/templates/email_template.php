<?php
	echo '<html><head></head>
            <body>
            <table cellspacing="0" cellpadding="0" style="padding:30px 10px;background:#EEE;width:100%;font-family:arial">
            <tbody>   
            <tr>
                <td>
                    <table cellspacing="0" align="center" style="max-width:650px;min-width:320px">
                        <tbody>
                            <tr>
                                <td style="text-align:left;padding-bottom:14px">
                                    <img align="left" src="'. asset_url() .'img/logolife.png" alt="'. $store_name .'"></img>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" style="background:#FFF;border:1px solid #e4e4e4;padding:50px 30px">
                                    <table align="center">
                                    <tbody>
                                    
                                    <tr>
                                        <td style="color:#666;padding:15px 5px;font-size:14px;line-height:20px;font-family:arial">
                                            <p style="font-weight:bold;font-size:16px">Hello ' . $recever_name . ',</p>' .
                                            $email_content  
                                                   . '</br>
                                                   Best Regards,
                                                    <br/>
                                                    '. $store_name .'
                                            </p>
                                        </td>
                                    </tr>
                                    </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" style="background:#F8F8F8;border:1px solid #e4e4e4;border-top:none;padding:24px 10px">
                                <p></p>         
                                
                                </td>               
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                
                    <table style="max-width:650px" align="center">
                        
                        <tbody><tr>
                            <td style="color:#b4b4b4;font-size:11px;padding-top:10px;line-height:15px;font-family:arial">

                                © '. $store_name .' 2015 
                                
                            </td>

                        </tr>
                    </tbody></table>
                
            </tr>
            </tbody>
        
            </table>
            </body>
        </html>';
?>