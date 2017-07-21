<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <xsl:text disable-output-escaping='yes'>&lt;!DOCTYPE html></xsl:text>
        <html>
            <head>
                <meta charset="UTF-8"/>
                <title>PHPCS</title>
                <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"/>
                <style>
                    body {
                    padding-top: 10px;
                    }

                    .hatching {
                    color: #fff !important;
                    padding: .2em .6em .3em !important;
                    border-radius: .25em !important;
                    }

                    .hatching-good {
                    background-color: #5cb85c !important;
                    }

                    .hatching-warning {
                    background-color: #f0ad4e !important;
                    }

                    .hatching-critical {
                    background-color: #d9534f !important;
                    }
                </style>
            </head>
            <body>

                <div class="container">
                    <h3>PHPCS</h3>
                </div>
                <div class="container">
                    <h4>Summary</h4>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th><div align="left">File Name</div></th>
                                <th><div align="center">Errors</div></th>
                                <th><div align="center">Warnings</div></th>
                            </tr>
                        </thead>
                        <tbody>
                            <xsl:for-each select="phpcs/file">
                            <tr>
                                <td><xsl:value-of select="@name"/></td>
                                <td><div class="text-center"><xsl:value-of select="@errors"/></div></td>
                                <td><div class="text-center"><xsl:value-of select="@warnings"/></div></td>
                            </tr>
                            </xsl:for-each>
                        </tbody>
                    </table>
                </div>
                <br/>
                <br/>
                <div class="container">
                    <h4>Details</h4>
                    <xsl:apply-templates select="phpcs/file"/>

                </div>
            </body>
        </html>
    </xsl:template>
    <xsl:template match="file">
    <table class="table" style="margin-top:25px;">
        <thead>
            <tr>
                <th colspan="4"><xsl:value-of select="@name"/></th>
            </tr>
            <tr>
                <td><div align="left">Level</div></td>
                <td><div align="right">Line:Col</div></td>
                <td><div align="left">Violation</div></td>
                <td><div align="left">Rule</div></td>
            </tr>
        </thead>
        <tbody>
        <xsl:for-each select="error|warning">

            <xsl:choose>
                <xsl:when test="name(.)='error'">
                    <tr class="danger">
                        <td>Error</td>
                        <td><div class="text-right"><xsl:value-of select="@line"/>:<xsl:value-of select="@column"/></div></td>
                        <td><xsl:value-of select="."/></td>
                        <td><xsl:value-of select="@source"/></td>
                    </tr>
                </xsl:when>
                <xsl:when test="name(.)='warning'">
                    <tr class="warning">
                        <td>Warning</td>
                        <td><xsl:value-of select="@line"/>:<xsl:value-of select="column"/></td>
                        <td><xsl:value-of select="."/></td>
                        <td><xsl:value-of select="@source"/></td>
                    </tr>
                </xsl:when>
            </xsl:choose>
        </xsl:for-each>
        </tbody>
    </table>
    </xsl:template>
</xsl:stylesheet>