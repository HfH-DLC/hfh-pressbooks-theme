document.addEventListener("DOMContentLoaded", function () {
  var t = document.querySelectorAll(
    "#content section ".concat("h2", ":not(.entry-title)")
  );
  Array.prototype.forEach.call(t, function (t) {
    (t.innerHTML =
      '\n\t\t<button aria-expanded="false" class="button--text">\n\t\t  <span>'.concat(
        t.innerHTML,
        '</span>\n\t\t  <svg aria-hidden="true" focusable="false" viewBox="0 0 10 10">\n\t\t\t<rect class="vert" height="8" width="2" y="1" x="4"/>\n\t\t\t<rect height="2" width="8" y="4" x="1"/>\n\t\t  </svg>\n\t\t</button>'
      )),
      t.setAttribute("data-collapsed", "true");
    var e = (function (t) {
        for (
          var e = [];
          t.nextElementSibling &&
          "H2" !== t.nextElementSibling.tagName &&
          !t.nextElementSibling.classList.contains("nav-reading--page") &&
          !(
            ("DIV" === t.nextElementSibling.tagName &&
              ("glossary" === t.nextElementSibling.className ||
                "contributors" === t.nextElementSibling.className ||
                "footnotes" === t.nextElementSibling.className ||
                t.nextElementSibling.classList.contains(
                  "media-attributions"
                ))) ||
            ("HR" === t.nextElementSibling.tagName &&
              (t.nextElementSibling.classList.contains("before-footnotes") ||
                t.nextElementSibling.classList.contains("before-contributors")))
          );

        )
          e.push(t.nextElementSibling), (t = t.nextElementSibling);
        return (
          e.forEach(function (t) {
            t.parentNode.removeChild(t);
          }),
          e
        );
      })(t),
      n = document.createElement("div");
    (n.hidden = !0),
      e.forEach(function (t) {
        n.appendChild(t);
      }),
      t.parentNode.insertBefore(n, t.nextElementSibling);
    var i = t.querySelector("button");
    i.onclick = function () {
      var e = "true" === i.getAttribute("aria-expanded") || !1;
      if (
        (i.setAttribute("aria-expanded", !e),
        t.setAttribute("data-collapsed", e),
        (n.hidden = e),
        window.dispatchEvent(new Event("resize")),
        !e && !t.hasAttribute("data-unfurled"))
      ) {
        var a = n.querySelectorAll("iframe");
        Array.prototype.forEach.call(a, function (t) {
          var e, n, i;
          ((e = t.src),
          (n = e.match(/^https?:\/\/([^/?#]+)(?:[/?#]|$)/i)),
          (i = n && n[1]),
          "string" == typeof i || i instanceof String ? i : "").includes(
            "phet.colorado.edu"
          ) && (t.src = t.src);
        });
      }
      t.setAttribute("data-unfurled", !0);
    };
  });
});
