
(function (global, factory) {
    typeof exports === 'object' && typeof module !== 'undefined' ? factory() :
        typeof define === 'function' && define.amd ? define(factory) :
            (factory());
}(this, (function () {
    'use strict';

    function Masker(target) {
        var maskText = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
        var self;
        var regexLocalTable = {
            '0': {
                pattern: /\d/
            },
            'S': {
                pattern: /[a-zA-Z]/
            }
        };

        var getRegex = function getRegex(position) {
            return regexLocalTable[maskText[position]];
        };

        var isSplitter = function isSplitter(char, position) {
            return char == maskText[position];
        };

        var regexTest = function regexTest(char, position) {
            var regex = getRegex(position);

            if (regex && regex.pattern.test(char)) {
                return true;
            } else if (isSplitter(char, position)) {
                return true;
            } else if (getRegex(position + 1) && getRegex(position + 1).pattern.test(char)) {
                self.value += maskText[position] + char;
                return false;
            } else {
                return false;
            }
        };

        var mask = function mask() {
            self = this;
            this.setAttribute('maxlength', maskText.length);
            this.addEventListener('keypress', function (e) {
                var char = e.key;
                var position = this.value.length;

                if (!regexTest(char, position)) {
                    e.preventDefault();
                }
            });
        };

        target.each(mask);
    }

    if (typeof window !== 'undefined') {
        var plugin = window.$ || window.jQuery || window.Zepto;

        if (plugin) {
            plugin.fn.masker = function MaskerPlugin(maskText) {
                Masker(this, maskText);
                return this;
            };

            plugin.maskerHtml = function MaskerHtmlPlugin() {
                var domElements = $('input');
                domElements.filter("*[data-masker]").each(function () {
                    Masker($(this), this.getAttribute('data-masker'));
                });
            };
        }
    }

})));