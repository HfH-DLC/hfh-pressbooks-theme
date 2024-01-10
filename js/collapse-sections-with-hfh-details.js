/**
 * This file is currently not in use. It is supposed to be used instead of collapse-sections.js, if we choose to allow collapsed sections again.
 * It currently contains the workaround to reload the iframe content after wrapping the content in the details element in order to deal with the loading issues.
 */
document.addEventListener("DOMContentLoaded", function () {
  // Get all the headings
  const sectionHeadingEl = "h2";
  const headings = document.querySelectorAll(
    `#content section ${sectionHeadingEl}:not(.entry-title)`
  );

  Array.prototype.forEach.call(headings, (heading) => {
    // Wrap each <h2> in a details element
    let next = heading.nextElementSibling;
    let parent = heading.parentNode;
    heading.outerHTML = `
          <details>
            <summary><h2>${heading.innerHTML}</h2></summary>
          </details>`;
    if (next) {
      heading = next.previousElementSibling;
    } else {
      heading = parent.lastChild;
    }

    // Function to create a node list
    // of the content between this <h2> and the next
    /**
     * @param elem
     */
    const getContent = (elem) => {
      let elems = [];
      while (
        elem.nextElementSibling &&
        elem.nextElementSibling.tagName !== "H2" &&
        !elem.nextElementSibling.classList.contains("nav-reading--page") &&
        elem.nextElementSibling.id !== "hfh-course-progress-chapter-complete" &&
        !(
          (elem.nextElementSibling.tagName === "DIV" &&
            (elem.nextElementSibling.className === "glossary" ||
              elem.nextElementSibling.className === "contributors" ||
              elem.nextElementSibling.className === "footnotes" ||
              elem.nextElementSibling.classList.contains(
                "media-attributions"
              ))) ||
          (elem.nextElementSibling.tagName === "HR" &&
            (elem.nextElementSibling.classList.contains("before-footnotes") ||
              elem.nextElementSibling.classList.contains(
                "before-contributors"
              )))
        )
      ) {
        elems.push(elem.nextElementSibling);
        elem = elem.nextElementSibling;
      }

      // Delete the old versions of the content nodes
      elems.forEach((node) => {
        node.parentNode.removeChild(node);
      });

      return elems;
    };

    // Assign the contents to be expanded/collapsed (array)
    let contents = getContent(heading);

    // Add each element of `contents` to `heading`
    contents.forEach((node) => {
      heading.appendChild(node);
    });

    const iframes = heading.querySelectorAll("iframe");
    iframes.forEach((iframe) => {
      const contentId = iframe.dataset.contentId;
      const contentData = H5PIntegration.contents["cid-" + contentId];
      const contentLanguage =
        contentData &&
        contentData.metadata &&
        contentData.metadata.defaultLanguage
          ? contentData.metadata.defaultLanguage
          : "en";
      iframe.contentDocument.open();
      iframe.contentDocument.write(
        '<!doctype html><html class="h5p-iframe" lang="' +
          contentLanguage +
          '"><head>' +
          H5P.getHeadTags(contentId) +
          '</head><body><div class="h5p-content" data-content-id="' +
          contentId +
          '"/></body></html>'
      );
      iframe.contentDocument.close();
    });
  });
});
