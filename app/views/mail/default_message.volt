{% extends "1-base.volt" %}

{% block content %}

    <tr>
        <td style="padding: 10px;">
            <!-- table content manager request-->
            <table style="max-width: 600px; width: 100%; margin:0; padding:0" border="0" cellpadding="0"
                   cellspacing="0" bgcolor="#fafafa">
                <tbody>

                {% include "1-greeting.volt" %}

                <tr>
                    <td style="text-align: center;">
                        {{ main_content }}
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>

{% endblock %}