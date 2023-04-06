import { RichText, useBlockProps } from '@wordpress/block-editor';

export default function Edit( props ) {
    const blockProps = useBlockProps( { className: "marquee-editor" } );
    const content = props.attributes.content;
    function onChangeContent( newContent ) {
        props.setAttributes( { content: newContent } );
    }
    return (
        <div {...blockProps}>
            <RichText
                tagName='p'
                onChange={onChangeContent}
                value={content}
                placeholder='マーキーのテキストを入力'
            />
        </div>
    );
}