import { RichText, useBlockProps } from '@wordpress/block-editor';

export default function save( props ) {
    const blockProps = useBlockProps.save( { className: "marquee" } );
	return (
        <div {...blockProps}>
            <RichText.Content
                tagName='p'
                value={props.attributes.content}
            />
        </div>
	);
}