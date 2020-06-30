<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* template.front.twig */
class __TwigTemplate_d5fd29b554bf121beedd16cd6440e59e8c6a16bc26b0927c3d9871e30b0ee575 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"fr\">
<head>

    <meta charset=\"UTF-8\">
    <meta name=\"theme-color\" content=\"#333333\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css\" integrity=\"sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh\" crossorigin=\"anonymous\">
    <link href=\"https://fonts.googleapis.com/icon?family=Material+Icons\" rel=\"stylesheet\">
    <link href=\"https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap\" rel=\"stylesheet\">
    <link rel=\"stylesheet\" href=\"/main.css\">
    ";
        // line 12
        $this->displayBlock('title', $context, $blocks);
        // line 13
        echo "
</head>
<body>

    ";
        // line 17
        echo twig_include($this->env, $context, "sidebar.twig");
        echo "

    ";
        // line 19
        echo twig_include($this->env, $context, "header.front.twig");
        echo "

    ";
        // line 21
        $this->displayBlock('content', $context, $blocks);
        // line 22
        echo "
    ";
        // line 23
        echo twig_include($this->env, $context, "footer.front.twig");
        echo "

    <script src=\"/bundle.js\" ></script>
    <script src=\"https://kit.fontawesome.com/a18c07149b.js\" crossorigin=\"anonymous\"></script>
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/gsap/3.2.6/gsap.min.js\"></script>
    <script src=\"https://code.jquery.com/jquery-3.4.1.slim.min.js\" integrity=\"sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n\" crossorigin=\"anonymous\"></script>
    <script src=\"https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js\" integrity=\"sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo\" crossorigin=\"anonymous\"></script>
    <script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js\" integrity=\"sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6\" crossorigin=\"anonymous\"></script>

</body>
</html>";
    }

    // line 12
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    // line 21
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    public function getTemplateName()
    {
        return "template.front.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  96 => 21,  90 => 12,  75 => 23,  72 => 22,  70 => 21,  65 => 19,  60 => 17,  54 => 13,  52 => 12,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "template.front.twig", "/homepages/13/d812002751/htdocs/jean_forteroche/app/View/template.front.twig");
    }
}
