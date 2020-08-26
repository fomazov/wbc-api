{% extends "1-base.volt" %}

{% block content %}

<tr>
    <td style="padding: 10px;">
        <!-- table content activation-->
        <table style="max-width: 600px; width: 100%; margin:0; padding:0" border="0" cellpadding="0"
               cellspacing="0" bgcolor="#fafafa">
            <tbody>

            {% include "1-greeting.volt" %}

            <tr>
                <td style="border-bottom: 20px solid transparent; padding: 10px; text-align: center; font-size: 16px;"
                    bgcolor="" valign="middle">
                    You need to activate your account by email
                </td>
            </tr>
            <tr>
                <td style="text-align: center;"><a
                        style="background:#F06346; color: #FFFFFF; padding:15px; line-height: 50px;  font-family: Arial,Verdana,sans-serif; font-size: 18px; font-weight: 700; text-decoration: none;"
                        href="{{ activateUrl }}"
                        target="_blank">Activate account</a></td>
            </tr>
            </tbody>
        </table>
    </td>
</tr>

{% endblock %}