var editorInit = function (editorId) {
    var editor = CodeMirror.fromTextArea($('#' + editorId).get(0), {
        lineNumbers: true,
        mode: "text/x-mysql",
        matchBrackets: true,
        lineWrapping: true,
        indentWithTabs: true,
        smartIndent: true,
        lineNumbeddrs: true,
        autofocus: true,
        keyMap: "vim",
        showCursorWhenSelection: true,
        theme: "blackboard"
    });

    return editor;
};