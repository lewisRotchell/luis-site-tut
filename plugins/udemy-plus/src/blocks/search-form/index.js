import { registerBlockType } from "@wordpress/blocks";
import {
  useBlockProps,
  PanelColorSettings,
  InspectorControls,
} from "@wordpress/block-editor";
import { __ } from "@wordpress/i18n";
import block from "./block.json";
import icons from "../../icons";
import "./main.css";

registerBlockType(block.name, {
  icon: icons.primary,
  edit: ({ attributes, setAttributes }) => {
    const { bgColor, textColor } = attributes;
    const blockProps = useBlockProps({
      style: {
        backgroundColor: bgColor,
        color: textColor,
      },
    });
    return (
      <>
        <InspectorControls>
          <PanelColorSettings
            title={__("Colors", "udemy-plus")}
            colorSettings={[
              {
                value: bgColor,
                onChange: (newColor) => setAttributes({ bgColor: newColor }),
                label: __("Background Color", "udemy-plus"),
              },
              {
                value: textColor,
                onChange: (newColor) => setAttributes({ textColor: newColor }),
                label: __("Text Color", "udemy-plus"),
              },
            ]}
          />
        </InspectorControls>
        <div {...blockProps}>
          <h1>Search: Your search term here</h1>
          <form>
            <input type="text" placeholder="Search" />
            <div className="btn-wrapper">
              <button
                style={{
                  backgroundColor: bgColor,
                  color: textColor,
                }}
                type="submit"
              >
                Search
              </button>
            </div>
          </form>
        </div>
      </>
    );
  },
});
