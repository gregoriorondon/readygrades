import React from "react";
import { InstagramEmbed } from "react-social-media-embed";

const InstagramPost = ({ url, width = 400 }) => {
  return (
    <div style={{ display: "flex", justifyContent: "center", width: "100%" }}>
      <InstagramEmbed url={url} width={width} captioned={false} />
    </div>
  );
};

export default InstagramPost;


